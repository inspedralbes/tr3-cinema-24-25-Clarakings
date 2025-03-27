<template>
    <div class="bg-neutral-900 py-8">
        <LegendSeats />
        <div class="container mx-auto px-4">
            <!-- Screen -->
            <div class="relative mb-12">
                <div class="w-3/4 h-2 bg-gray-600 mx-auto rounded-lg mb-4"></div>
                <p class="text-center text-gray-400 text-sm">PANTALLA</p>
            </div>

            <!-- Seats Grid -->
            <div class="max-w-4xl mx-auto">
                <div v-for="row in rows" class="flex justify-center items-center mb-4">
                    <div class="w-8 text-gray-300 font-semibold mr-4">{{ row }}</div>
                    <div class="flex flex-row space-x-2">
                        <div v-for="n in 10" class="relative">
                            <!-- Row Numbers -->
                            <div v-if="row === 'A'" class="absolute -top-8 w-full text-center text-gray-400 text-sm">
                                {{ n }}
                            </div>

                            <!-- Seats -->
                            <div class="group">
                                <div v-if="isOccupied(row, n)" class="cursor-not-allowed">
                                    <Seat class="fill-red-500 opacity-50"/>
                                </div>
                                <div v-else-if="isReservedByOthers(row, n)" class="cursor-not-allowed">
                                    <Seat class="fill-orange-100 opacity-50"/>
                                </div>
                                <div v-else-if="isSelected(row, n)" 
                                     @click="handleSeatClick(`${row}-${n}`)"
                                     class="cursor-pointer transform hover:scale-110 transition-all duration-300">
                                    <Seat class="fill-green-400"/>
                                </div>
                                <div v-else-if="isVIPSeat(row, n)" 
                                     @click="handleSeatClick(`${row}-${n}-VIP`)"
                                     class="cursor-pointer transform hover:scale-110 transition-all duration-300">
                                    <Seat class="fill-yellow-400"/>
                                </div>
                                <div v-else 
                                     @click="handleSeatClick(`${row}-${n}`)"
                                     class="cursor-pointer transform hover:scale-110 transition-all duration-300">
                                    <Seat class="fill-gray-300 hover:fill-green-400"/>
                                </div>

                                <!-- Tooltip -->
                                <div class="opacity-0 group-hover:opacity-100 absolute -top-8 left-1/2 transform -translate-x-1/2 
                                            bg-black text-white text-xs py-1 px-2 rounded transition-opacity duration-200">
                                    {{ `${row}-${n}` }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Error Alert -->
        <div v-show="errorAlert" class="fixed top-4 right-4 z-50">
            <ErrorPopup :error="error" />
        </div>
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
            this.errorAlert = true;
            setTimeout(() => {
                this.error = '';
                this.errorAlert = false;
            }, 15000);
        },
        isOccupied(row, n) {
            return this.ocuppiedSeats.includes(`${row}-${n}`) || 
                   this.ocuppiedSeats.includes(`${row}-${n}-VIP`);
        },
        isReservedByOthers(row, n) {
            return this.seatsRoomSocket.includes(`${row}-${n}`) || 
                   this.seatsRoomSocket.includes(`${row}-${n}-VIP`);
        },
        isSelected(row, n) {
            return this.selectedSeats.includes(`${row}-${n}`) || 
                   this.selectedSeats.includes(`${row}-${n}-VIP`);
        },
        isVIPSeat(row, n) {
            return row === 'F' && this.sessionVIP;
        },
        handleSeatClick(seatId) {
            const store = useAppStore();
            if (this.selectedSeats.length === 10 && !this.selectedSeats.includes(seatId)) {
                this.showError('No puedes seleccionar más de 10 asientos');
                return;
            }

            if (this.selectedSeats.includes(seatId)) {
                this.selectedSeats = this.selectedSeats.filter(id => id !== seatId);
            } else {
                this.selectedSeats.push(seatId);
            }

            store.setSelectedSeats(this.selectedSeats);
            socket.emit('updateSeats', { room: store.id_session, seats: this.selectedSeats });
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