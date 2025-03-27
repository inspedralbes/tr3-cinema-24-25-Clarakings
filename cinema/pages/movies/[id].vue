<template>
    <NuxtLayout name="navbar" />
    <div class="min-h-screen bg-neutral-900">
        <!-- Hero Section -->
        <div v-if="showMovie" class="relative h-[70vh]">
            <img :src="movie.image" :alt="movie.title" class="w-full h-full object-cover opacity-40">
            <div class="absolute inset-0 bg-gradient-to-t from-neutral-900 to-transparent"></div>
            <div class="absolute bottom-0 left-0 right-0 p-8">
                <div class="container mx-auto">
                    <h1 class="text-6xl font-bold text-white mb-4">{{ movie.title }}</h1>
                    <div class="flex items-center space-x-4 text-gray-300 mb-6">
                        <span>{{ movie.duration }}</span>
                        <span>•</span>
                        <span>{{ movie.gendre }}</span>
                        <span>•</span>
                        <span>{{ movie.classification }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Movie Details -->
        <div class="container mx-auto px-4 py-12">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Poster -->
                <div class="md:col-span-1">
                    <img :src="movie.image" :alt="movie.title" class="w-full rounded-lg shadow-xl">
                </div>

                <!-- Info -->
                <div class="md:col-span-2 text-white">
                    <div class="bg-neutral-800 rounded-lg p-6 shadow-xl">
                        <h2 class="text-2xl font-bold mb-4">Sinopsis</h2>
                        <p class="text-gray-300 mb-6">{{ movie.sinopsis }}</p>

                        <div class="grid grid-cols-2 gap-6">
                            <div>
                                <h3 class="text-lg font-semibold mb-2">Director</h3>
                                <p class="text-gray-300">{{ movie.director }}</p>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold mb-2">Fecha de Estreno</h3>
                                <p class="text-gray-300">{{ movie.premiere }}</p>
                            </div>
                        </div>

                        <div class="mt-6">
                            <h3 class="text-lg font-semibold mb-2">Reparto</h3>
                            <div class="flex flex-wrap gap-2">
                                <span v-for="actor in actors" :key="actor" 
                                    class="bg-neutral-700 px-3 py-1 rounded-full text-sm text-gray-300">
                                    {{ actor }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Sesiones -->
                    <div class="mt-8">
                        <h2 class="text-2xl font-bold mb-6">Próximas Sesiones</h2>
                        <SessionSection v-if="showMovie" :id_movie="$route.params.id" />
                    </div>
                </div>
            </div>
        </div>

        <!-- Películas Relacionadas -->
        <div class="bg-neutral-800 py-12 mt-8">
            <div class="container mx-auto px-4">
                <h2 class="text-2xl font-bold text-white mb-6">Películas Similares</h2>
                <MoviesCarousel :movies="movies" />
            </div>
        </div>
    </div>

    <!-- Loading State -->
    <div v-if="!showMovie" class="flex items-center justify-center h-screen bg-neutral-900">
        <div class="animate-spin rounded-full h-16 w-16 border-t-4 border-red-600"></div>
    </div>
</template>

<script>
import { getMovie, getAllMovies } from '../../services/communicationManager.js';
import { useAppStore } from '../../store/index';

export default {
    data() {
        return {
            movies: [],
            movie: {},
            actors: [],
            showMovie: false
        };
    },
    mounted() {
        if (this.$route.params.id !== undefined) {
            const store = useAppStore();
            getMovie(this.$route.params.id).then((response) => {
                this.movie = response;
                store.setMovie(response);
                store.setMovieId(parseInt(response.id_movie));
                
                // Asegurar que response.actors sea un array
                this.actors = Array.isArray(response.actors) ? response.actors : JSON.parse(response.actors || "[]");
                
                this.movies = store.all_movies;
                if (this.movies.length === 0) {
                    getAllMovies().then((response) => {
                        this.movies = response;
                        store.setAllMovies(response);
                    }).catch((error) => {
                        console.error(error);
                    });
                }
                this.showMovie = true;
            }).catch((error) => {
                console.error(error);
            });
        }
    }
};
</script>