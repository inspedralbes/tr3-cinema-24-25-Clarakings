<template>
    <NuxtLayout name="navbar" /> 
    <div class="mx-9">
        <h1 class="text-4xl mx-9 font-semibold tracking-wider text-center text-white py-8">¡Descubre todas nuestras sessiones!</h1>
        <p class="mb-9 text-xl text-center text-slate-300">Las mejores peliculas infantiles disponibles en CinesKings.</p>
    </div>
    <div class="flex justify-center items-center m-9">
        <table v-show="showSessions" class="border-collapse w-2/3 text-white">
            <thead>
                <tr class="bg-violet-700 text-2xl">
                    <th class="px-4 py-2">Fecha</th>
                    <th class="px-4 py-2">Hora</th>
                    <th class="px-4 py-2">Película</th>
                    <th class="px-4 py-2">Entradas</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="session in sessions" :key="session.id" class="bg-violet-400 text-center">
                    <td class="px-4 py-2">{{ session.day }}</td>
                    <td class="px-4 py-2">{{ session.hour }}</td>
                    <td class="px-4 py-2">{{ movies.find(movie => movie.id_movie == session.movie_id)?.title || 'No se encontró la película'}}</td>
                    <td class="px-4 py-2">
                        <nuxt-link v-if="session.total_tickets - session.tickets_sold > 0" :to="{ name: 'sessions-id', params: { id: session.id_session } }">
                            <button class="text-rose-500 font-semibold py-2 px-4 bg-violet-50 rounded-md shadow-sm hover:bg-violet-200">
                                Disponibles: {{session.total_tickets - session.tickets_sold}}
                            </button>
                        </nuxt-link>
                        <button v-else class="py-2 px-4 cursor-default">
                            Agotadas
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <MoviesCarousel :movies="movies" class="m-9"/>
    <div v-if="showSessions == false" class="flex items-center justify-center h-screen">
        <div class="loader ease-linear rounded-full border-4 border-t-4 border-gray-200 h-12 w-12"></div>
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
    },
    mounted() {
        const store = useAppStore();
        // Llamada a la API para obtener las películas
        getAllSessions()
            .then((response) => {
                this.sessions = response;
                store.setAllSessions(response);
                this.showSessions = true;
                // console.log(this.sessions);
            })
            .catch((error) => {
                console.error(error);
            });

        this.movies = store.all_movies;
        // console.log(this.movies);
        if (this.movies.length == 0) {
            getAllMovies()
                .then((response) => {
                    this.movies = response;
                    store.setAllMovies(response);
                    // console.log(this.movies);
                })
                .catch((error) => {
                    console.error(error);
                });
        }

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