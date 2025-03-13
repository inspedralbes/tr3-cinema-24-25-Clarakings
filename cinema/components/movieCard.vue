<template>
    <div>
        <div v-if="movie.id_movie">
            <nuxt-link :to="{ name: 'movies-id', params: { id: movie.id_movie } }">
                <div class="movie-card group relative overflow-hidden rounded-lg transition-all duration-300 hover:scale-105">
                    <img :src="movie.image" :alt="movie.title" class="w-full h-[400px] object-cover rounded-lg">
                    <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black to-transparent p-6 transform translate-y-2 group-hover:translate-y-0 transition-transform duration-300">
                        <p class="text-white text-xl font-bold mb-2">{{ movie.title }}</p>
                        <button class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700 transition-colors duration-300">
                            Comprar entradas
                        </button>
                    </div>
                </div>
            </nuxt-link>
        </div>
        <p v-else class="text-red-500">Error: ID de la película no definido</p>
    </div>
</template>

<script>
export default {
    props: {
        movie: Object
    },
    methods: {
    }
};
</script>