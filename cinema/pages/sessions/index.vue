<template>
    <NuxtLayout name="navbar" /> 
    <div class="min-h-screen bg-neutral-900">
        <div class="bg-gradient-to-r from-red-900 to-neutral-900 py-12">
            <div class="container mx-auto px-4">
                <h2 class="text-5xl font-bold text-white text-center mb-4">Sesiones Disponibles</h2>
                <p class="text-xl text-gray-300 text-center">Encuentra el mejor horario para tu película favorita</p>
            </div>
        </div>

        <div class="container mx-auto px-4 py-12">
            <div class="bg-neutral-800 rounded-xl shadow-xl overflow-hidden">
                <div class="overflow-x-auto">
                    <table v-show="showSessions" class="w-full">
                        <thead class="bg-neutral-700">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Fecha</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Hora</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Película</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Entradas</th>
                            </tr>
                        </thead>
                        <tbody class="bg-neutral-800 divide-y divide-neutral-700">
                            <tr v-for="session in sessions" :key="session.id" class="hover:bg-neutral-700 transition-colors duration-200">
                                <td class="px-6 py-4 whitespace-nowrap text-gray-300">{{ session.day }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-300">{{ session.hour }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-300">
                                    {{ movies.find(movie => movie.id_movie == session.movie_id)?.title || 'No disponible' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <nuxt-link v-if="session.total_tickets - session.tickets_sold > 0" 
                                              :to="{ name: 'sessions-id', params: { id: session.id_session } }"
                                              class="inline-flex items-center px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors duration-300">
                                        <span class="mr-2">Disponibles: {{ session.total_tickets - session.tickets_sold }}</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </nuxt-link>
                                    <span v-else class="text-gray-500 font-medium">Agotadas</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="container mx-auto px-4 py-8">
            <h3 class="text-2xl font-bold text-white mb-6">Películas Destacadas</h3>
            <MoviesCarousel :movies="movies" class="bg-neutral-800 rounded-xl p-6"/>
        </div>
    </div>

    <div v-if="!showSessions" class="flex items-center justify-center h-96">
        <div class="animate-spin rounded-full h-16 w-16 border-t-4 border-red-600"></div>
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