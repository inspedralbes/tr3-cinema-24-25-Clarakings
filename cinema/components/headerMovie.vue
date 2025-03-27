<template>
    <div class="relative">
        <!-- Background Image -->
        <div class="absolute inset-0">
            <img :src="movie.image" :alt="movie.title" 
                 class="w-full h-full object-cover filter blur-sm opacity-30">
            <div class="absolute inset-0 bg-gradient-to-b from-neutral-900 to-transparent"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-neutral-900 to-transparent"></div>
        </div>

        <!-- Content -->
        <div class="relative py-16 px-4 sm:px-6 lg:px-8">
            <div class="max-w-7xl mx-auto">
                <div class="text-center">
                    <!-- Title -->
                    <h1 class="text-5xl sm:text-6xl md:text-7xl font-bold text-white mb-6 
                             tracking-tight leading-tight">
                        {{ movie.title }}
                    </h1>

                    <!-- Movie Info -->
                    <div class="flex flex-wrap justify-center items-center gap-4 mb-8">
                        <span class="px-4 py-2 bg-red-600 text-white rounded-full text-sm font-medium">
                            {{ movie.genre }}
                        </span>
                        <span class="px-4 py-2 bg-neutral-700 text-white rounded-full text-sm font-medium">
                            {{ movie.duration }}
                        </span>
                        <span class="px-4 py-2 bg-neutral-700 text-white rounded-full text-sm font-medium">
                            {{ movie.classification }}
                        </span>
                    </div>

                    <!-- Description -->
                    <p class="mt-6 text-xl text-gray-300 max-w-3xl mx-auto leading-relaxed">
                        Descubre los detalles de {{ movie.title }} y vive una experiencia cinematográfica única.
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        movie: Object
    }
};
</script>