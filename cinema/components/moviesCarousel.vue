<template>
    <div class="overflow-x-auto whitespace-nowrap custom-scrollbar bg-blue-950">
        <div class="flex space-x-4 bg-blue-950">
            <div v-for="(movie, index) in movies" :key="index" class="w-28 flex-shrink-0 bg-blue-950">
                <nuxt-link :to="{ name: 'movies-id', params: { id: movie.id_movie } }">
                    <div class="w-full bg-blue-950 rounded-lg p-2">
                        <img :src="movie.image" class="w-full h-auto rounded-lg bg-blue-950"
                            :alt="`Movie poster for ${movie.title}`">
                    </div>
                </nuxt-link>
            </div>
        </div>
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
    width: 4px;
    /* Ajusta este valor para cambiar el ancho del scrollbar */
}

.custom-scrollbar::-webkit-scrollbar-track {
    background: #1a202c;
    /* Cambia este color según lo necesites */
}

.custom-scrollbar::-webkit-scrollbar-thumb {
    background-color: #4a5568;
    /* Cambia este color según lo necesites */
    border-radius: 3px;
}
</style>