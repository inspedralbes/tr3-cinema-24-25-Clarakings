<template>
    <LegendSeats />
    <div class="m-9 text-2xl text-white">
        <div v-for="row in rows" class="flex justify-center my-1">
            <div class="flex items-center mr-9"> {{ row }} </div>
            <div class="flex flex-row">
                <div v-for="n in 10" class="flex flex-row items-center justify-center">
                    <div v-if="row == 'A'" class="absolute transform -translate-y-9 mb-9" :class="n % 5 == 0 ? 'mr-8  ml-1' : 'mx-1'">{{ n }}</div>                    
                    <div v-if="this.ocuppiedSeats.includes(`${row}-${n}`) || this.ocuppiedSeats.includes(`${row}-${n}-VIP`)" class="flex flex-row items-center justify-center text-2xl">
                        <Seat   :id="`${row}-${n}`" 
                                :class="n % 5 == 0 ? 'mr-8 my-1 ml-1' : 'mx-1 -my-1'"
                                class="cursor-not-allowed fill-red-500"/>
                    </div>
                    <div v-else-if="this.seatsRoomSocket.includes(`${row}-${n}`) || this.seatsRoomSocket.includes(`${row}-${n}-VIP`)" class="flex flex-row items-center justify-center text-2xl">
                        <Seat   :id="`${row}-${n}`" 
                                :class="n % 5 == 0 ? 'mr-8 my-1 ml-1' : 'mx-1 -my-1'"
                                class="cursor-not-allowed fill-orange-100"/>
                    </div>
                    <div v-else-if="this.selectedSeats.includes(`${row}-${n}`) || this.selectedSeats.includes(`${row}-${n}-VIP`)" class="flex flex-row items-center justify-center text-2xl">
                        <Seat   :id="`${row}-${n}`" 
                                :class="n % 5 == 0 ? 'mr-8 my-1 ml-1' : 'mx-1 -my-1'"
                                class="cursor-pointer fill-green-300"
                                @click="handleSeatClick(`${row}-${n}`)"/>
                    </div>
                    <div v-else-if="row == 'F' && this.sessionVIP" class="flex flex-row items-center justify-center text-2xl">
                        <Seat   :id="`${row}-${n}-VIP`" 
                                :class="n % 5 == 0 ? 'mr-8 my-1 ml-1' : 'mx-1 -my-1'"
                                class="cursor-pointer fill-yellow-500"
                                @click="handleSeatClick(`${row}-${n}-VIP`)"/>
                    </div>
                    <div v-else class="flex flex-row items-center justify-center text-2xl">
                        <Seat   :id="`${row}-${n}`" 
                                :class="n % 5 == 0 ? 'mr-8 my-1 ml-1' : 'mx-1 -my-1'"
                                class="cursor-pointer fill-slate-300"
                                @click="handleSeatClick(`${row}-${n}`)"/>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div v-show="errorAlert">
        <ErrorPopup :error="this.error" />
    </div>
</template>

<script>
import { useAppStore } from '../store/index';
import { socket } from '../services/socket';

export default {
    props: {
        ocuppiedSeats: {
            type: Array,
            required: true
        }
    },
    data() {        
        return {
            rows: ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L'],
            selectedSeats: [],
            seatsRoomSocket: [],
            sessionVIP: false,
            error: '',
            errorAlert: false
        }
    },
    methods: {
        showError(message) {
            this.error = message;
            this.errorAlert = true; // Mostrar el mensaje de error
            setTimeout(() => {
                this.error = '';
                this.errorAlert = false;
            }, 15000); // Ocultar el mensaje después de 15 segundos
        },
        selectedSeat(seat){
            seat.classList.remove('fill-slate-300');
            seat.classList.remove('fill-yellow-500');
            seat.classList.add('fill-green-300');
        },
        unselectedSeat(seat, seatID){
            seat.classList.remove('fill-green-300');
            if (seatID[0] == 'F') {
                seat.classList.add('fill-yellow-500');
            } else {
                seat.classList.add('fill-slate-300');
            }
        },
        handleSeatClick(seatId) {
            const store = useAppStore();
            let seat = document.getElementById(seatId);
            // console.log(seatId);
            if (this.selectedSeats.length == 10 && seat.classList.contains('fill-slate-300')) {
                this.showError('No puedes seleccionar más de 10 asientos');
            } else {
                if (this.selectedSeats.includes(seatId)) {
                    this.selectedSeats = this.selectedSeats.filter(id => id != seatId);
                    store.setSelectedSeats(this.selectedSeats);
                    this.unselectedSeat(seat, seatId);
                    // console.log(store.selectedSeats);
                    socket.emit('updateSeats', { room: store.id_session, seats: this.selectedSeats });
                } else {
                    this.selectedSeats.push(seatId);
                    store.setSelectedSeats(this.selectedSeats);
                    this.selectedSeat(seat);
                    // console.log(store.selectedSeats);
                    socket.emit('updateSeats', { room: store.id_session, seats: this.selectedSeats });
                }
            }
        }
    },
    mounted() {
        const store = useAppStore();
        this.sessionVIP = store.session.vip;
        this.selectedSeats = store.selectedSeats;
        this.seatsRoomSocket = store.seatsRoomSocket;
    }
}
</script>