<template>
    <NuxtLayout name="navbar" />
    <div v-if="showSession == true">
        <div class="flex flex-col items-center justify-center">
            <img :src="movie.image" :alt="movie.title" class="w-full object-cover h-auto max-h-40 mb-4">
            <h1 class="text-white text-6xl font-mono font-bold tracking-widest mb-6">{{ movie.title }}</h1>
            <div class="flex flex-col items-center justify-center w-full md:m-7 text-slate-300">
                <div class="flex flex-col md:flex-row justify-center items-center w-full md:w-5/6 md:mb-3">
                    <h2 class="text-lg md:text-xl font-mono font-bold tracking-widest mb-2 md:m-0 mr-0 md:mr-4">
                        Duración: {{ movie.duration }}</h2>
                    <h2 class="text-lg md:text-xl font-mono font-bold tracking-widest mb-2 md:m-0 ml-0 md:ml-4">Fecha de
                        Estreno: {{ movie.premiere }}</h2>
                </div>
                <div class="flex flex-col md:flex-row justify-center items-center w-full md:w-5/6 md:mb-3">
                    <h2 class="text-lg md:text-xl font-mono font-bold tracking-widest mb-2 md:m-0 mr-0 md:mr-4">Session:
                        {{ session.day }}, {{ session.hour }}</h2>
                </div>
            </div>
        </div>

        <div :key="componentSeatsKey">
            <SelectSeats :ocuppiedSeats="this.ocuppiedSeats" />
        </div>
        <div v-show="showResumen" class="flex justify-center mt-3 mb-9">
            <div class="flex flex-col items-center mx-9 text-white">
                <div class="p-4 text-3xl font-bold tracking-wider">
                    Asientos seleccionados
                </div>
                <div class="flex flex-col items-center justify-center">
                    <div v-for="seat in selectedSeats" :key="seat" class="px-2 mx-2 text-lg">
                        {{ seat }} || {{ seat.includes('VIP') ? (parseFloat(session.priceBase) + 2.00).toFixed(2) :
                            session.priceBase }} €
                    </div>
                </div>
                <div class="m-5">
                    <button class="mx-3 px-3 py-1 text-xl bg-violet-500 rounded-lg" @click="formForBuy()">
                        Comprar
                    </button>
                </div>
            </div>
        </div>

        <div v-show="showForm"
            class="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-white rounded-lg p-9 my-8 w-96">
            <button @click="showForm = false"
                class="absolute top-0 right-0 mt-3 mr-3 text-gray-400 hover:text-gray-600 focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
            <form class="max-w-sm mx-auto" method="POST">
                <div class="mb-5">
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Correo
                        electrónico</label>
                    <input type="email" id="email"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                        placeholder="example@gmail.com" required />
                </div>
                <div class="mb-5">
                    <label for="password"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre(s)</label>
                    <input type="text" id="name"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                        required />
                </div>
                <div class="mb-5">
                    <label for="password"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Apellido(s)</label>
                    <input type="text" id="last-name"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                        required />
                </div>
                <div class="mb-5">
                    <label for="repeat-password"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Teléfono</label>
                    <input type="text" id="number-phone"
                        class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light"
                        required />
                </div>
                <button
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                    @click.prevent="buyTickets()">¡Confirmar Compra!</button>
            </form>
        </div>

        <div v-show="errorAlert">
            <ErrorPopup :error="this.error" />
        </div>
    </div>

    <div v-if="showSession == false" class="flex items-center justify-center h-screen">
        <div class="loader ease-linear rounded-full border-4 border-t-4 border-gray-200 h-12 w-12"></div>
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
        showError(message) {
            this.error = message;
            this.errorAlert = true; // Mostrar el mensaje de error
            setTimeout(() => {
                this.error = '';
                this.errorAlert = false;
            }, 15000); // Ocultar el mensaje después de 15 segundos
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
                    first_name: document.getElementById('name').value,
                    last_name: document.getElementById('last-name').value,
                    phone_number: document.getElementById('number-phone').value
                },
                seats: store.selectedSeats
            };
            const dataValidateEmail = {
                session_id: store.id_session,
                email: data.cliente.email
            };

            if (data.cliente.email == '' || data.cliente.first_name == '' || data.cliente.last_name == '' || data.cliente.phone_number == '' || data.seats.length == 0) {
                this.showError('Faltan datos para completar la compra');
            } else {
                postValidateEmail(dataValidateEmail).then(responseValidateEmail => {
                    // console.log('Respuesta de la validación de correo electrónico:', responseValidateEmail);
                    if (responseValidateEmail.comprar == 'True') {
                        // Si se puede comprar, entonces realizar la compra de entradas
                        postBuyEntradas(data).then(responseBuyEntradas => {
                            // console.log('Respuesta de la compra de entradas:', responseBuyEntradas);
                            socket.emit('exitFromRoom', store.id_session);
                            this.showForm = false;
                            this.showResumen = false;
                            store.setSelectedSeats([]);
                            this.$router.push({ path: '/' });
                        }).catch(error => {
                            console.error('Error al comprar entradas:', error);
                        });
                    } else {
                        this.showError('Ya tienes entradas compradas.');
                    }
                }).catch(error => {
                    console.error('Error al validar el correo electrónico:', error);
                });

            }
        }
    },
    mounted() {
        const store = useAppStore();
        store.setSessionId(this.$route.params.id);
        // Llamada a la API para obtener las películas
        getSession(store.id_session).then((response) => {
            this.session = response;
            store.setSession(response);
            //Buscar la película
            store.setMovieId(this.session.movie_id);
            getMovie(store.id_movie).then((response) => {
                this.movie = response;
                store.setMovie(response);
            }).catch((error) => {
                console.error(error);
            });
            //Buscar los asientos ocupados
            getOccupiedSeats(store.id_session).then((response) => {
                if (response.message) {
                    // console.log(response.message);
                } else {
                    this.ocuppiedSeats = response;
                    store.setOccupiedSeats(this.ocuppiedSeats);
                }
                this.showSession = true;
            }).catch((error) => {
                console.error(error);
            });
        }).catch((error) => {
            console.error(error);
        });

        socket.emit('connectToRoom', store.id_session);

        socket.on('updateSeatsRoom', (data) => {
            const updatedSeatsRoom = data.filter(item => item.socket_id != socket.id);
            let seats = [];
            for (let i = 0; i < updatedSeatsRoom.length; i++) {
                if (updatedSeatsRoom[i].seats.length > 0) {
                    for (let j = 0; j < updatedSeatsRoom[i].seats.length; j++) {
                        seats.push(updatedSeatsRoom[i].seats[j]);
                    }
                }
            }
            store.setSeatsRoomSocket(seats);
            this.seatsRoomSocket = seats;
            // console.log(seats);
            this.componentSeatsKey++;
        });

        setInterval(() => {
            this.selectedSeats = store.selectedSeats;
            // console.log(this.selectedSeats);
            if (this.selectedSeats.length > 0) {
                this.showResumen = true;
            } else {
                this.showResumen = false;
                this.showForm = false;
            }
        }, 500);
    }
}
</script>

<style scoped>
@keyframes loader {
    0% {
        transform: rotate(0deg);
    }

    100% {
        transform: rotate(360deg);
    }
}

.loader {
    border-top-color: #3498db;
    animation: loader 1.5s linear infinite;
}
</style>