<template>
    <div class="relative">
        <!-- Carousel Container -->
        <div class="overflow-x-auto whitespace-nowrap custom-scrollbar bg-neutral-900 py-6">
            <div class="flex space-x-6 px-4">
                <div v-for="(movie, index) in movies" :key="index" 
                     class="w-48 flex-shrink-0 transform transition-all duration-300 hover:scale-105">
                    <nuxt-link :to="{ name: 'movies-id', params: { id: movie.id_movie } }">
                        <div class="relative group">
                            <img :src="movie.image" 
                                 :alt="`Poster de ${movie.title}`"
                                 class="w-full h-72 object-cover rounded-lg shadow-lg">
                            <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-60 
                                      transition-all duration-300 rounded-lg flex items-center justify-center">
                                <div class="opacity-0 group-hover:opacity-100 transform translate-y-4 
                                          group-hover:translate-y-0 transition-all duration-300">
                                    <p class="text-white text-center font-semibold px-4">{{ movie.title }}</p>
                                </div>
                            </div>
                        </div>
                    </nuxt-link>
                </div>
            </div>
        </div>

        <!-- Gradient Edges -->
        <div class="absolute top-0 bottom-0 left-0 w-12 bg-gradient-to-r from-neutral-900 to-transparent"></div>
        <div class="absolute top-0 bottom-0 right-0 w-12 bg-gradient-to-l from-neutral-900 to-transparent"></div>
    </div>
</template>

<script>
export default {
    props: {
        movies: Object
    }
};
</script>

<style scoped>
.custom-scrollbar::-webkit-scrollbar {
    height: 6px;
}

.custom-scrollbar::-webkit-scrollbar-track {
    background: #262626;
    border-radius: 3px;
}

.custom-scrollbar::-webkit-scrollbar-thumb {
    background-color: #525252;
    border-radius: 3px;
    transition: all 0.3s;
}

.custom-scrollbar::-webkit-scrollbar-thumb:hover {
    background-color: #666666;
}
</style>