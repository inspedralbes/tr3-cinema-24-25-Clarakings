<template>
  <NuxtLayout name="navbar" /> 
  <HeaderLanding />
  <div class="flex flex-wrap justify-center bg-blue-950">
    <MovieCard v-for="movie in movies" :key="movie.id_movie" :movie="movie" class="m-4 cursor-pointer"/>
  </div>
  <div v-if="showMovies == false" class="flex items-center justify-center h-screen">
    <div class="loader ease-linear rounded-full border-4 border-t-4 border-gray-200 h-12 w-12"></div>
  </div>
</template>

<script>
import { getAllMovies } from '../services/communicationManager.js';
import { useAppStore } from '../store/index';

export default {
  components: {

  },
  data() {
    return {
      movies: [],
      showMovies: false
    };
  },
  methods: {
    
  },
  mounted() {
    const store = useAppStore();
    this.movies = store.all_movies;
    // Llamada a la API para obtener las películas
    if (this.movies.length == 0) {
      getAllMovies()
        .then((response) => {        
          // response: title, image, id.
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