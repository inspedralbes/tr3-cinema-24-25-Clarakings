<template>
    <NuxtLayout name="navbar" />
    <div class="min-h-screen bg-neutral-900">
        <!-- Movie Header -->
        <div v-if="showSession" class="relative h-[40vh]">
            <img :src="movie.image" :alt="movie.title" class="w-full h-full object-cover opacity-40">
            <div class="absolute inset-0 bg-gradient-to-t from-neutral-900 to-transparent"></div>
            <div class="absolute bottom-0 left-0 right-0 p-8">
                <div class="container mx-auto">
                    <h1 class="text-4xl font-bold text-white mb-2">{{ movie.title }}</h1>
                    <div class="flex items-center space-x-4 text-gray-300">
                        <span>{{ session.day }}</span>
                        <span>•</span>
                        <span>{{ session.hour }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Seat Selection -->
        <div class="container mx-auto px-4 py-12">
            <div :key="componentSeatsKey">
                <SelectSeats :ocuppiedSeats="ocuppiedSeats" />
            </div>

            <!-- Selected Seats Summary -->
            <div v-show="showResumen" class="mt-8 bg-neutral-800 rounded-lg p-6 shadow-xl">
                <h2 class="text-2xl font-bold text-white mb-4">Resumen de tu selección</h2>
                <div class="space-y-4">
                    <div v-for="seat in selectedSeats" :key="seat" class="flex justify-between items-center text-gray-300">
                        <span>Asiento {{ seat }}</span>
                        <span class="font-semibold">{{ seat.includes('VIP') ? 
                            (parseFloat(session.priceBase) + 2.00).toFixed(2) : session.priceBase }} €</span>
                    </div>
                    <div class="border-t border-neutral-700 pt-4 mt-4">
                        <div class="flex justify-between items-center text-white">
                            <span class="font-bold">Total</span>
                            <span class="font-bold text-xl">
                                {{ calculateTotal() }} €
                            </span>
                        </div>
                    </div>
                    <button @click="formForBuy()" 
                        class="w-full bg-red-600 text-white py-3 rounded-lg hover:bg-red-700 transition-colors duration-300 mt-6">
                        Continuar con la compra
                    </button>
                </div>
            </div>
        </div>

        <!-- Purchase Form Modal -->
        <div v-show="showForm" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4">
            <div class="bg-neutral-800 rounded-xl p-8 max-w-md w-full relative">
                <button @click="showForm = false" class="absolute top-4 right-4 text-gray-400 hover:text-white">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>

                <h2 class="text-2xl font-bold text-white mb-6">Finalizar Compra</h2>
                <form class="space-y-4">
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-300 mb-2">Correo electrónico</label>
                        <input type="email" id="email" 
                            class="w-full px-4 py-2 bg-neutral-700 border border-neutral-600 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-red-500">
                    </div>
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-300 mb-2">Nombre</label>
                        <input type="text" id="name"
                            class="w-full px-4 py-2 bg-neutral-700 border border-neutral-600 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-red-500">
                    </div>
                    <div>
                        <label for="surname" class="block text-sm font-medium text-gray-300 mb-2">Apellidos</label>
                        <input type="text" id="surname"
                            class="w-full px-4 py-2 bg-neutral-700 border border-neutral-600 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-red-500">
                    </div>
                    <div>
                        <label for="number-phone" class="block text-sm font-medium text-gray-300 mb-2">Teléfono</label>
                        <input type="tel" id="number-phone"
                            class="w-full px-4 py-2 bg-neutral-700 border border-neutral-600 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-red-500">
                    </div>
                    <button @click.prevent="buyTickets()"
                        class="w-full bg-red-600 text-white py-3 rounded-lg hover:bg-red-700 transition-colors duration-300">
                        Confirmar Compra
                    </button>
                </form>
            </div>
        </div>

        <!-- Error Alert -->
        <div v-show="errorAlert" class="fixed top-4 right-4 max-w-sm">
            <div class="bg-red-600 text-white px-6 py-4 rounded-lg shadow-lg">
                <p class="font-medium">{{ error }}</p>
            </div>
        </div>
    </div>
</template>

<script>
import { getSession, getMovie, getOccupiedSeats, postValidateEmail, postBuyEntradas } from '../../services/communicationManager.js';
import { useAppStore } from '../../store/index';
import { socket } from '../../services/socket';

export default {
    data() {
        return {
            session: {},
            movie: {},
            ocuppiedSeats: [],
            selectedSeats: [],
            seatsRoomSocket: [],
            componentSeatsKey: 0,
            error: '',
            showSession: false,
            showResumen: false,
            showForm: false,
            errorAlert: false
        };
    },
    methods: {
        calculateTotal() {
            return this.selectedSeats.reduce((total, seat) => {
                return total + (seat.includes('VIP') ? 
                    parseFloat(this.session.priceBase) + 2.00 : 
                    parseFloat(this.session.priceBase));
            }, 0).toFixed(2);
        },
        showError(message) {
            this.error = message;
            this.errorAlert = true;
            setTimeout(() => {
                this.error = '';
                this.errorAlert = false;
            }, 15000);
        },
        formForBuy() {
            this.showForm = true;
        },
        buyTickets() {
            const store = useAppStore();
            const data = {
                session_id: store.id_session,
                cliente: {
                    email: document.getElementById('email').value,
                    name: document.getElementById('name').value,
                    surname: document.getElementById('surname').value,
                    phone_number: document.getElementById('number-phone').value
                },
                seats: store.selectedSeats
            };

            if (!data.cliente.email || !data.cliente.name || !data.cliente.surname || 
                !data.cliente.phone_number || data.seats.length === 0) {
                this.showError('Por favor, completa todos los campos');
                return;
            }

            postValidateEmail({ 
                session_id: store.id_session, 
                email: data.cliente.email 
            }).then(response => {
                if (response.comprar === 'True') {
                    postBuyEntradas(data).then(() => {
                        socket.emit('exitFromRoom', store.id_session);
                        this.showForm = false;
                        this.showResumen = false;
                        store.setSelectedSeats([]);
                        this.$router.push('/');
                    }).catch(error => {
                        this.showError('Error al procesar la compra');
                        console.error(error);
                    });
                } else {
                    this.showError('Ya tienes entradas compradas para esta sesión');
                }
            }).catch(error => {
                this.showError('Error al validar el correo electrónico');
                console.error(error);
            });
        }
    },
    mounted() {
        const store = useAppStore();
        store.setSessionId(this.$route.params.id);

        getSession(store.id_session).then((response) => {
            this.session = response;
            store.setSession(response);
            store.setMovieId(this.session.movie_id);

            getMovie(store.id_movie).then((response) => {
                this.movie = response;
                store.setMovie(response);
            });

            getOccupiedSeats(store.id_session).then((response) => {
                if (!response.message) {
                    this.ocuppiedSeats = response;
                    store.setOccupiedSeats(this.ocuppiedSeats);
                }
                this.showSession = true;
            });
        });

        socket.emit('connectToRoom', store.id_session);

        socket.on('updateSeatsRoom', (data) => {
            const updatedSeatsRoom = data.filter(item => item.socket_id != socket.id);
            const seats = updatedSeatsRoom.reduce((acc, curr) => {
                return acc.concat(curr.seats);
            }, []);
            
            store.setSeatsRoomSocket(seats);
            this.seatsRoomSocket = seats;
            this.componentSeatsKey++;
        });

        setInterval(() => {
            this.selectedSeats = store.selectedSeats;
            this.showResumen = this.selectedSeats.length > 0;
            if (!this.showResumen) {
                this.showForm = false;
            }
        }, 500);
    }
}
</script>