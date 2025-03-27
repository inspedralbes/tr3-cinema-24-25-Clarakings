<template>
    <nuxt-link :to="{ name: 'sessions-id', params: { id: session.id_session } }">
        <div class="bg-neutral-800 hover:bg-neutral-700 transition-all duration-300 rounded-xl shadow-xl p-6 transform hover:scale-105">
            <!-- Date and Time -->
            <div class="flex items-center justify-between mb-4">
                <div>
                    <h3 class="text-2xl font-bold text-white">{{ formatDate(session.day) }}</h3>
                    <p class="text-xl text-red-500 font-semibold">{{ session.hour }}</p>
                </div>
                <div class="bg-neutral-900 rounded-full p-3">
                    <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>

            <!-- Session Info -->
            <div class="space-y-3">
                <div class="flex items-center text-gray-300">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                    <span>Sala {{ session.id_session }}</span>
                </div>
                <div class="flex items-center text-gray-300">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/>
                    </svg>
                    <span>Entradas disponibles: {{ session.total_tickets - session.tickets_sold }}</span>
                </div>
                <div class="flex items-center text-gray-300">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span>{{ session.priceBase }}€</span>
                </div>
            </div>

            <!-- Action Button -->
            <button class="mt-6 w-full bg-red-600 text-white py-3 px-4 rounded-lg hover:bg-red-700 
                         transition-colors duration-300 flex items-center justify-center">
                <span>Seleccionar asientos</span>
                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </button>
        </div>
    </nuxt-link>
</template>

<script>
export default {
    props: {
        session: Object
    },
    methods: {
        formatDate(dateString) {
            const options = { weekday: 'long', day: 'numeric', month: 'long' };
            return new Date(dateString).toLocaleDateString('es-ES', options);
        }
    }
};
</script>