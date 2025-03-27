<template>
  <NuxtLayout name="navbar" /> 
  <HeaderLanding />
  <div class="bg-neutral-900 py-12">
    <div class="container mx-auto px-4">
      <h2 class="text-4xl font-bold text-white text-center mb-8">Cartelera</h2>
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <MovieCard v-for="movie in movies" :key="movie.id_movie" :movie="movie" />
      </div>
    </div>
  </div>
  <div v-if="!showMovies" class="flex items-center justify-center h-96">
    <div class="animate-spin rounded-full h-16 w-16 border-t-4 border-red-600"></div>
  </div>
</template>

<script>
import { getAllMovies } from '../services/communicationManager.js';
import { useAppStore } from '../store/index';

export default {
  data() {
    return {
      movies: [],
      showMovies: false
    };
  },
  mounted() {
    const store = useAppStore();
    this.movies = store.all_movies;
    if (this.movies.length == 0) {
      getAllMovies()
        .then((response) => {        
          this.movies = response;
          store.setAllMovies(response);
          this.showMovies = true;
        })
        .catch((error) => {
          console.error(error);
        });
    } else {
      this.showMovies = true;
    }
  }
};
</script>