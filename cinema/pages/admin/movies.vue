<template>
  <div class="min-h-screen bg-neutral-900">
    <NuxtLayout name="navbar" />

    <!-- Header -->
    <div class="bg-gradient-to-r from-red-900 to-neutral-900 py-12">
      <div class="container mx-auto px-4">
        <h2 class="text-5xl font-bold text-white text-center mb-4">
          Gestión de Películas
        </h2>
        <p class="text-xl text-gray-300 text-center">
          Administra el catálogo de películas de tu cine
        </p>
      </div>
    </div>

    <!-- Form Section -->
    <div class="container mx-auto px-4 py-8">
      <div class="max-w-4xl mx-auto bg-neutral-800 rounded-xl shadow-xl p-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <!--Imagen -->
          <div class="md:col-span-2">
            <label class="block text-sm font-medium text-gray-300 mb-2"
              >URL de la Imagen</label
            >
            <input
              v-model="image"
              type="text"
              class="w-full px-4 py-2 bg-neutral-700 border border-neutral-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent"
            />
          </div>

          <!-- Título y Director -->
          <div>
            <label class="block text-sm font-medium text-gray-300 mb-2"
              >Título</label
            >
            <input
              v-model="title"
              type="text"
              class="w-full px-4 py-2 bg-neutral-700 border border-neutral-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent"
            />
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-300 mb-2"
              >Director</label
            >
            <input
              v-model="director"
              type="text"
              class="w-full px-4 py-2 bg-neutral-700 border border-neutral-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent"
            />
          </div>

          <!-- Actores y Sinopsis -->
          <div class="md:col-span-2">
            <label class="block text-sm font-medium text-gray-300 mb-2"
              >Actores</label
            >
            <input
              v-model="actors"
              type="text"
              class="w-full px-4 py-2 bg-neutral-700 border border-neutral-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent"
            />
          </div>
          <div class="md:col-span-2">
            <label class="block text-sm font-medium text-gray-300 mb-2"
              >Sinopsis</label
            >
            <textarea
              v-model="sinopsis"
              rows="3"
              class="w-full px-4 py-2 bg-neutral-700 border border-neutral-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent"
            ></textarea>
          </div>

          <!-- Duración, Estreno, Género y Clasificación -->
          <div>
            <label class="block text-sm font-medium text-gray-300 mb-2"
              >Duración</label
            >
            <input
              v-model="duration"
              type="text"
              class="w-full px-4 py-2 bg-neutral-700 border border-neutral-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent"
            />
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-300 mb-2"
              >Fecha de Estreno</label
            >
            <input
              v-model="premiere"
              type="date"
              class="w-full px-4 py-2 bg-neutral-700 border border-neutral-600 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent"
            />
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-300 mb-2"
              >Género</label
            >
            <input
              v-model="gendre"
              type="text"
              class="w-full px-4 py-2 bg-neutral-700 border border-neutral-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent"
            />
          </div>
          <div>
            <label class="block text-sm font-medium text-gray-300 mb-2"
              >Clasificación</label
            >
            <input
              v-model="classification"
              type="text"
              class="w-full px-4 py-2 bg-neutral-700 border border-neutral-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent"
            />
          </div>
        </div>

        <!-- Botones de acción -->
        <div class="flex justify-center space-x-4 mt-8">
          <button
            @click="crearMovie()"
            class="px-6 py-3 bg-green-600 text-white font-medium rounded-lg hover:bg-green-700 transition-colors duration-300 flex items-center"
          >
            <svg
              xmlns="http://www.w3.org/2000/svg"
              class="h-5 w-5 mr-2"
              viewBox="0 0 20 20"
              fill="currentColor"
            >
              <path
                fill-rule="evenodd"
                d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                clip-rule="evenodd"
              />
            </svg>
            Crear Película
          </button>
          <button
            @click="actualizarMovie()"
            class="px-6 py-3 bg-yellow-600 text-white font-medium rounded-lg hover:bg-yellow-700 transition-colors duration-300 flex items-center"
          >
            <svg
              xmlns="http://www.w3.org/2000/svg"
              class="h-5 w-5 mr-2"
              viewBox="0 0 20 20"
              fill="currentColor"
            >
              <path
                fill-rule="evenodd"
                d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z"
                clip-rule="evenodd"
              />
            </svg>
            Actualizar Película
          </button>
          <button
            @click="eliminarMovie(id)"
            class="px-6 py-3 bg-red-600 text-white font-medium rounded-lg hover:bg-red-700 transition-colors duration-300 flex items-center"
          >
            <svg
              xmlns="http://www.w3.org/2000/svg"
              class="h-5 w-5 mr-2"
              viewBox="0 0 20 20"
              fill="currentColor"
            >
              <path
                fill-rule="evenodd"
                d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                clip-rule="evenodd"
              />
            </svg>
            Eliminar Película
          </button>
        </div>
      </div>
    </div>

    <!-- Table Section -->
    <div class="container mx-auto px-4 py-8">
      <div class="bg-neutral-800 rounded-xl shadow-xl overflow-hidden">
        <h3
          class="text-2xl font-bold text-white p-6 border-b border-neutral-700"
        >
          Lista de Películas
        </h3>
        <div class="overflow-x-auto">
          <table class="w-full">
            <thead class="bg-neutral-700">
              <tr>
                <th
                  class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider"
                >
                  ID
                </th>
                <th
                  class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider"
                >
                  Título
                </th>
                <th
                  class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider"
                >
                  Director
                </th>
                <th
                  class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider"
                >
                  Actores
                </th>
                <th
                  class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider"
                >
                  Sinopsis
                </th>
                <th
                  class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider"
                >
                  Duración
                </th>
                <th
                  class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider"
                >
                  Estreno
                </th>
                <th
                  class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider"
                >
                  Género
                </th>
                <th
                  class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider"
                >
                  Clasificación
                </th>
              </tr>
            </thead>
            <tbody class="bg-neutral-800 divide-y divide-neutral-700">
              <tr
                v-for="movie in movies"
                :key="movie.id_movie"
                @click="editarMovie(movie)"
                class="hover:bg-neutral-700 cursor-pointer transition-colors duration-200"
              >
                <td class="px-6 py-4 whitespace-nowrap text-gray-300">
                  {{ movie.id_movie }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-gray-300">
                  {{ movie.title }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-gray-300">
                  {{ movie.director }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-gray-300">
                  {{ movie.actors }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-gray-300">
                  {{ movie.sinopsis }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-gray-300">
                  {{ movie.duration }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-gray-300">
                  {{ movie.premiere }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-gray-300">
                  {{ movie.gendre }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-gray-300">
                  {{ movie.classification }}
                </td>
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
import { useAppStore } from "../../store/index";
import {
  getAllMovies,
  addMovie,
  updateMovie,
  deleteMovie,
} from "../../services/communicationManager";

export default {
  data() {
    return {
      id: "",
      image: "",
      title: "",
      director: "",
      actors: [],
      sinopsis: "",
      duration: "",
      premiere: "",
      gendre: "",
      classification: "",
      movies: [],
      error: "",
      errorAlert: false,
      succes: "",
      succesAlert: false,
    };
  },
  methods: {
    showSucces(message) {
      this.succes = message;
      this.succesAlert = true;
      setTimeout(() => {
        this.succes = "";
        this.succesAlert = false;
      }, 15000);
    },
    showError(message) {
      this.error = message;
      this.errorAlert = true;
      setTimeout(() => {
        this.error = "";
        this.errorAlert = false;
      }, 15000);
    },
    crearMovie() {
      const store = useAppStore();
      const data = {
        image: this.image,
        title: this.title,
        director: this.director,
        actors: this.actors.split(",").map((actor) => actor.trim()), // Convert comma-separated string to array
        sinopsis: this.sinopsis,
        duration: this.duration,
        premiere: this.premiere,
        gendre: this.gendre,
        classification: this.classification,
      };
      addMovie(data, store.token)
        .then((response) => {
          console.log(response);
          this.actualizarDatos();
          this.showSucces("Película creada correctamente");
        })
        .catch((error) => {
          console.error("Error creating movie:", error);
          this.showError(error);
        });
    },
    actualizarMovie() {
      const store = useAppStore();
      const data = {
        id: this.id,
        image: this.image,
        title: this.title,
        director: this.director,
        actors: [`${this.actors}`],
        sinopsis: this.sinopsis,
        duration: this.duration,
        premiere: this.premiere,
        gendre: this.gendre,
        classification: this.classification,
      };
      updateMovie(data, store.token)
        .then((response) => {
          console.log(response);
          this.actualizarDatos();
          this.showSucces("Película actualizada correctamente");
        })
        .catch((error) => {
          this.showError(error);
        });
    },
    eliminarMovie() {
      const store = useAppStore();
      deleteMovie(this.id, store.token)
        .then((response) => {
          console.log(response);
          this.actualizarDatos();
          this.showSucces("Película eliminada correctamente");
        })
        .catch((error) => {
          this.showError(error);
        });
    },
    editarMovie(movie) {
      this.id = movie.id_movie;
      this.title = movie.title;
      this.director = movie.director;
      this.actors = movie.actors;
      this.sinopsis = movie.sinopsis;
      this.duration = movie.duration;
      this.premiere = movie.premiere;
      this.gendre = movie.gendre;
      this.classification = movie.classification;
    },
    actualizarDatos() {
      const store = useAppStore();
      getAllMovies(store.token).then((response) => {
        this.movies = response;
        console.log(response);
      });
    },
  },
  mounted() {
    const store = useAppStore();
    if (store.user?.type != 1) {
      this.$router.push("/");
      return;
    }

    getAllMovies(store.token).then((response) => {
      this.movies = response;
      console.log(response);
    });
  },
};
</script>