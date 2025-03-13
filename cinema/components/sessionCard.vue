<template>
    <nuxt-link :to="{ name: 'sessions-id', params: { id: session.id_session } }">
        <div class="bg-neutral-800 hover:bg-neutral-700 transition-all duration-300 rounded-lg shadow-xl p-6 transform hover:scale-105">
            <h3 class="text-2xl font-bold text-white mb-3">{{ session.day }}</h3>
            <p class="text-xl text-red-500 font-semibold mb-2">{{ session.hour }}</p>
            <div class="space-y-2">
                <p class="text-gray-300">Entradas totales: {{ session.total_tickets }}</p>
                <p class="text-gray-300">Vendidas: {{ session.tickets_sold }}</p>
                <p class="text-xl text-white font-bold mt-4">
                    Disponibles: {{session.total_tickets - session.tickets_sold}}
                </p>
            </div>
            <button class="mt-4 w-full bg-red-600 text-white py-2 rounded-md hover:bg-red-700 transition-colors duration-300">
                Seleccionar
            </button>
        </div>
    </nuxt-link>
</template>

<script>
export default {
    props: {
        session: Object
    },
    data() {
        return {
            
        };
    },
    methods: {
    },
};
</script>