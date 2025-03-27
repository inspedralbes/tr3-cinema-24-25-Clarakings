<template>
    <NuxtLayout name="navbar" />
    <div class="min-h-screen bg-neutral-900">
        <!-- Hero Section -->
        <div class="bg-gradient-to-r from-red-900 to-neutral-900 py-16">
            <div class="container mx-auto px-4">
                <h1 class="text-5xl font-bold text-white text-center mb-4">Cartelera y Horarios</h1>
                <p class="text-xl text-gray-300 text-center">Encuentra tu sesión perfecta y disfruta del mejor cine</p>
            </div>
        </div>

        <!-- Filters Section -->
        <div class="container mx-auto px-4 py-8">
            <div class="bg-neutral-800 rounded-xl p-6 mb-8">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Fecha</label>
                        <input type="date" class="w-full px-4 py-2 bg-neutral-700 border border-neutral-600 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-red-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Película</label>
                        <select class="w-full px-4 py-2 bg-neutral-700 border border-neutral-600 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-red-500">
                            <option value="">Todas las películas</option>
                            <option v-for="movie in movies" :key="movie.id_movie" :value="movie.id_movie">
                                {{ movie.title }}
                            </option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Formato</label>
                        <select class="w-full px-4 py-2 bg-neutral-700 border border-neutral-600 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-red-500">
                            <option value="">Todos los formatos</option>
                            <option value="2D">2D</option>
                            <option value="3D">3D</option>
                            <option value="IMAX">IMAX</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sessions Grid -->
        <div class="container mx-auto px-4 pb-12">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div v-for="session in sessions" :key="session.id_session" 
                     class="bg-neutral-800 rounded-xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300">
                    <!-- Movie Image -->
                    <div class="relative h-48">
                        <img :src="getMovieImage(session.movie_id)" 
                             :alt="getMovieTitle(session.movie_id)"
                             class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-black to-transparent"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-4">
                            <h3 class="text-xl font-bold text-white">{{ getMovieTitle(session.movie_id) }}</h3>
                        </div>
                    </div>
                    
                    <!-- Session Info -->
                    <div class="p-6">
                        <div class="flex justify-between items-center mb-4">
                            <div>
                                <p class="text-gray-300">{{ session.day }}</p>
                                <p class="text-xl font-bold text-white">{{ session.hour }}</p>
                            </div>
                            <div class="text-right">
                                <p class="text-gray-300">Disponibles</p>
                                <p class="text-xl font-bold text-red-500">
                                    {{ session.total_tickets - session.tickets_sold }}
                                </p>
                            </div>
                        </div>

                        <div class="space-y-2">
                            <div class="flex items-center text-gray-300">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                          d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                </svg>
                                <span>Sala {{ session.id_session }}</span>
                            </div>
                            <div class="flex items-center text-gray-300">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                          d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <span>{{ session.priceBase }}€</span>
                            </div>
                        </div>

                        <nuxt-link v-if="session.total_tickets - session.tickets_sold > 0"
                                  :to="{ name: 'sessions-id', params: { id: session.id_session } }"
                                  class="block w-full mt-6">
                            <button class="w-full bg-red-600 text-white py-3 rounded-lg hover:bg-red-700 transition-colors duration-300 flex items-center justify-center">
                                <span>Comprar entradas</span>
                                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </button>
                        </nuxt-link>
                        <div v-else class="mt-6">
                            <button disabled class="w-full bg-gray-600 text-gray-300 py-3 rounded-lg cursor-not-allowed">
                                Agotado
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Loading State -->
        <div v-if="!showSessions" class="flex items-center justify-center h-96">
            <div class="animate-spin rounded-full h-16 w-16 border-t-4 border-red-600"></div>
        </div>
    </div>
</template>

<script>
import { getAllSessions, getAllMovies } from '../../services/communicationManager.js';
import { useAppStore } from '../../store/index';

export default {
    data() {
        return {
            sessions: [],
            movies: [],
            showSessions: false
        };
    },
    methods: {
        getMovieTitle(movieId) {
            const movie = this.movies.find(m => m.id_movie === movieId);
            return movie ? movie.title : 'Película no disponible';
        },
        getMovieImage(movieId) {
            const movie = this.movies.find(m => m.id_movie === movieId);
            return movie ? movie.image : '';
        }
    },
    mounted() {
        const store = useAppStore();
        getAllSessions()
            .then((response) => {
                this.sessions = response;
                store.setAllSessions(response);
                this.showSessions = true;
            })
            .catch((error) => {
                console.error(error);
            });

        this.movies = store.all_movies;
        if (this.movies.length == 0) {
            getAllMovies()
                .then((response) => {
                    this.movies = response;
                    store.setAllMovies(response);
                })
                .catch((error) => {
                    console.error(error);
                });
        }
    }
}
</script>