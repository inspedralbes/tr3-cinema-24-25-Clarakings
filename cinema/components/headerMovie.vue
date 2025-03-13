<template>
    <div class="bg-blue-950 py-8">
        <div class="container mx-auto">
            <h2 class="text-6xl font-semibold tracking-wider text-center text-white py-2">¡{{movie.title}}!</h2>
            <p class="mt-4 py-3 text-xl text-center text-slate-300">Descubre los detalles de la película {{ movie.title }}.</p>
        </div>
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