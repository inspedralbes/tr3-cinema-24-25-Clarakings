<template>
    <div class="group">
        <div v-if="movie.id_movie">
            <nuxt-link :to="{ name: 'movies-id', params: { id: movie.id_movie } }">
                <div class="relative overflow-hidden rounded-xl shadow-xl transform transition-all duration-300 hover:scale-105">
                    <!-- Movie Image -->
                    <img :src="movie.image" :alt="movie.title" 
                         class="w-full h-[500px] object-cover">
                    
                    <!-- Gradient Overlay -->
                    <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent opacity-90"></div>
                    
                    <!-- Content -->
                    <div class="absolute bottom-0 left-0 right-0 p-6 transform translate-y-2 
                                transition-transform duration-300 group-hover:translate-y-0">
                        <h3 class="text-2xl font-bold text-white mb-3">{{ movie.title }}</h3>
                        <p class="text-gray-300 mb-4 line-clamp-2">{{ movie.sinopsis }}</p>
                        
                        <!-- Info Tags -->
                        <div class="flex flex-wrap gap-2 mb-4">
                            <span class="px-3 py-1 bg-red-600 text-white text-sm rounded-full">
                                {{ movie.genre }}
                            </span>
                            <span class="px-3 py-1 bg-neutral-700 text-white text-sm rounded-full">
                                {{ movie.duration }}
                            </span>
                        </div>
                        
                        <!-- Action Button -->
                        <button class="w-full bg-red-600 text-white px-6 py-3 rounded-lg 
                                     hover:bg-red-700 transition-colors duration-300 flex items-center justify-center">
                            <span>Comprar Entradas</span>
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M9 5l7 7-7 7"/>
                            </svg>
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
    }
};
</script>