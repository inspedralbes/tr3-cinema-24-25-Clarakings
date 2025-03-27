<template>
    <div class="min-h-screen bg-neutral-900">
        <NuxtLayout name="navbar" />
        
        <!-- Header -->
        <div class="bg-gradient-to-r from-red-900 to-neutral-900 py-12">
            <div class="container mx-auto px-4">
                <h2 class="text-5xl font-bold text-white text-center mb-4">Gestión de Sesiones</h2>
                <p class="text-xl text-gray-300 text-center">Administra las sesiones y horarios de tu cine</p>
            </div>
        </div>

        <!-- Form Section -->
        <div class="container mx-auto px-4 py-8">
            <div class="max-w-4xl mx-auto bg-neutral-800 rounded-xl shadow-xl p-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Fecha y Hora -->
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Fecha</label>
                        <input v-model="day" type="date"
                            class="w-full px-4 py-2 bg-neutral-700 border border-neutral-600 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Hora (00:00:00)</label>
                        <input v-model="hour" type="text" placeholder="00:00:00"
                            class="w-full px-4 py-2 bg-neutral-700 border border-neutral-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent">
                    </div>

                    <!-- Película y Precio -->
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Película</label>
                        <select v-model="selectedMovie"
                            class="w-full px-4 py-2 bg-neutral-700 border border-neutral-600 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent">
                            <option value="" selected>Seleccionar película</option>
                            <option v-for="movie in movies" :key="movie.id_movie" :value="movie.id_movie">
                                {{ movie.title }}
                            </option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Precio Base</label>
                        <input v-model="priceBase" type="number"
                            class="w-full px-4 py-2 bg-neutral-700 border border-neutral-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent">
                    </div>

                    <!-- Checkboxes -->
                    <div class="md:col-span-2 grid grid-cols-2 gap-6">
                        <div class="flex items-center">
                            <input v-model="isDiscount" type="checkbox" class="h-4 w-4 text-red-600 focus:ring-red-500 border-neutral-600 rounded">
                            <label class="ml-2 block text-sm text-gray-300">Día del Espectador</label>
                        </div>
                        <div class="flex items-center">
                            <input v-model="hasVipSeats" type="checkbox" class="h-4 w-4 text-red-600 focus:ring-red-500 border-neutral-600 rounded">
                            <label class="ml-2 block text-sm text-gray-300">Asientos VIP</label>
                        </div>
                    </div>
                </div>

                <!-- Botones de acción -->
                <div class="flex justify-center space-x-4 mt-8">
                    <button @click="crearSession()"
                        class="px-6 py-3 bg-green-600 text-white font-medium rounded-lg hover:bg-green-700 transition-colors duration-300 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                                clip-rule="evenodd" />
                        </svg>
                        Crear Sesión
                    </button>
                    <button @click="actualizarSession()"
                        class="px-6 py-3 bg-yellow-600 text-white font-medium rounded-lg hover:bg-yellow-700 transition-colors duration-300 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z"
                                clip-rule="evenodd" />
                        </svg>
                        Actualizar Sesión
                    </button>
                    <button @click="eliminarSession()"
                        class="px-6 py-3 bg-red-600 text-white font-medium rounded-lg hover:bg-red-700 transition-colors duration-300 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                clip-rule="evenodd" />
                        </svg>
                        Eliminar Sesión
                    </button>
                </div>
            </div>
        </div>

        <!-- Table Section -->
        <div class="container mx-auto px-4 py-8">
            <div class="bg-neutral-800 rounded-xl shadow-xl overflow-hidden">
                <h3 class="text-2xl font-bold text-white p-6 border-b border-neutral-700">Lista de Sesiones</h3>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-neutral-700">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Día</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Hora</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">ID Película</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Día Espectador</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Precio Base</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">VIP</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Total Tickets</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Tickets Vendidos</th>
                            </tr>
                        </thead>
                        <tbody class="bg-neutral-800 divide-y divide-neutral-700">
                            <tr v-for="session in sessions" :key="session.id_session" @click="editarSession(session)"
                                class="hover:bg-neutral-700 cursor-pointer transition-colors duration-200">
                                <td class="px-6 py-4 whitespace-nowrap text-gray-300">{{ session.id_session }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-300">{{ session.day }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-300">{{ session.hour }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-300">{{ session.movie_id }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-300">{{ session.audienceDay }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-300">{{ session.priceBase }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-300">{{ session.vip }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-300">{{ session.total_tickets }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-300">{{ session.tickets_sold }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Notifications -->
        <div v-show="errorAlert" class="fixed top-4 right-4 max-w-sm">
            <div class="bg-red-600 text-white px-6 py-4 rounded-lg shadow-lg">
                <p class="font-medium">{{ error }}</p>
            </div>
        </div>

        <div v-show="succesAlert" class="fixed top-4 right-4 max-w-sm">
            <div class="bg-green-600 text-white px-6 py-4 rounded-lg shadow-lg">
                <p class="font-medium">{{ succes }}</p>
            </div>
        </div>
    </div>
</template>

<script>
import { useAppStore } from '../../store/index';
import { moviesFreeSession, addSession, getAllSessions, updateSession, deleteSession } from '../../services/communicationManager';

export default {
    data() {
        return {
            id: '',
            day: '',
            hour: '',
            selectedMovie: '',
            priceBase: '',
            isDiscount: false,
            hasVipSeats: false,
            movies: [],
            error: '',
            errorAlert: false,
            succes: '',
            succesAlert: false,
            sessions: []
        };
    },
    methods: {
        showSucces(message) {
            this.succes = message;
            this.succesAlert = true;
            setTimeout(() => {
                this.succes = '';
                this.succesAlert = false;
            }, 15000);
        },
        showError(message) {
            this.error = message;
            this.errorAlert = true;
            setTimeout(() => {
                this.error = '';
                this.errorAlert = false;
            }, 15000);
        },
        crearSession() {
            const store = useAppStore();
            const data = {
                day: this.day,
                hour: this.hour,
                movie_id: this.selectedMovie,
                priceBase: this.priceBase,
                audienceDay: this.isDiscount,
                vip: this.hasVipSeats
            };
            addSession(data, store.token).then((response) => {
                console.log(response);
                this.showSucces('Sesión creada correctamente');
                this.actualizarDatos();
            }).catch((error) => {
                this.showError(error);
            });
        },
        actualizarSession() {
            const store = useAppStore();
            const data = {
                id: this.id,
                day: this.day,
                hour: this.hour,
                movie_id: this.selectedMovie,
                priceBase: this.priceBase,
                audienceDay: this.isDiscount,
                vip: this.hasVipSeats
            };
            updateSession(data, store.token).then((response) => {
                console.log(response);
                this.showSucces('Sesión actualizada correctamente');
                this.actualizarDatos();
            }).catch((error) => {
                this.showError(error);
            });
        },
        eliminarSession() {
            const store = useAppStore();
            deleteSession(this.id, store.token).then((response) => {
                console.log(response);
                this.showSucces('Sesión eliminada correctamente');
                this.actualizarDatos();
            }).catch((error) => {
                this.showError(error);
            });
        },
        editarSession(session) {
            this.id = session.id_session;
            this.day = session.day;
            this.hour = session.hour;
            this.selectedMovie = session.movie_id;
            this.priceBase = session.priceBase;
            this.isDiscount = session.audienceDay;
            this.hasVipSeats = session.vip;
        },
        actualizarDatos() {
            const store = useAppStore();
            moviesFreeSession(store.token).then((response) => {
                this.movies = response;
                console.log(response);
            });
            getAllSessions().then((response) => {
                this.sessions = response;
                console.log(response);
            });
        }
    },
    mounted() {
        const store = useAppStore();
        if (store.user?.type != 1) {
            this.$router.push('/');
            return;
        }
        
        moviesFreeSession(store.token).then((response) => {
            this.movies = response;
            console.log(response);
        });
        getAllSessions().then((response) => {
            this.sessions = response;
            console.log(response);
        });
    }
}
</script>