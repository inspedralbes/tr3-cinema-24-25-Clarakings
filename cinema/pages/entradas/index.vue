<template>
    <NuxtLayout name="navbar" />
    <div class="min-h-screen bg-neutral-900">
        <!-- Hero Section -->
        <div class="bg-gradient-to-r from-red-900 to-neutral-900 py-16">
            <div class="container mx-auto px-4">
                <h1 class="text-5xl font-bold text-white text-center mb-4">Mis Entradas</h1>
                <p class="text-xl text-gray-300 text-center">Consulta y gestiona tus compras en CinesKings</p>
            </div>
        </div>

        <!-- Search Section -->
        <div class="container mx-auto px-4 py-8">
            <div class="max-w-3xl mx-auto bg-neutral-800 rounded-xl shadow-xl p-6 mb-8">
                <h2 class="text-2xl font-bold text-white mb-6">Buscar Entradas</h2>
                <div class="flex flex-col md:flex-row gap-4">
                    <div class="flex-1">
                        <label class="block text-sm font-medium text-gray-300 mb-2">Correo Electrónico</label>
                        <input type="email" v-model="email" 
                               class="w-full px-4 py-2 bg-neutral-700 border border-neutral-600 rounded-lg 
                                      text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-red-500"
                               placeholder="ejemplo@email.com">
                    </div>
                    <div class="flex items-end">
                        <button @click="searchEntradas()" 
                                class="w-full md:w-auto px-6 py-2 bg-red-600 text-white rounded-lg 
                                       hover:bg-red-700 transition-colors duration-300 flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                            <span>Buscar</span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Results Section -->
            <div v-if="showTickets1 && tickets1">
                <h3 class="text-2xl font-bold text-white mb-6">Resultados de la Búsqueda</h3>
                <TableListTickets :tickets="tickets1" />
            </div>

            <div v-if="showTickets2 && tickets2">
                <h3 class="text-2xl font-bold text-white mb-6">Historial de Compras</h3>
                <TableListTickets :tickets="tickets2" />
            </div>

            <!-- Empty State -->
            <div v-if="!showTickets1 && !showTickets2" class="text-center py-12">
                <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                          d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                <p class="text-gray-400">No se encontraron registros de compras</p>
            </div>
        </div>
    </div>
</template>

<script>
import { useAppStore } from '../../store/index';
import { getEntradasWithEmail, getEntradasWithEmailSession } from '../../services/communicationManager';

export default {
    data() {
        return {
            sessionId: Number,
            email: '',
            tickets1: {},
            tickets2: {},
            showTickets1: false,
            showTickets2: false
        }
    },
    methods: {
        searchEntradas() {
            const store = useAppStore();
            if (this.sessionId && this.email) {
                const data = {
                    email: this.email,
                    id: this.sessionId
                }
                getEntradasWithEmailSession(data, store.token).then((response) => {
                    this.tickets2 = {};
                    this.showTickets2 = false;
                    this.tickets1 = response;
                    this.showTickets1 = true;
                });
            } else if (this.email && !this.sessionId) {
                const data = {
                    email: this.email
                }
                getEntradasWithEmail(data, store.token).then((response) => {
                    this.tickets1 = {};
                    this.showTickets1 = false;
                    this.tickets2 = response;
                    this.showTickets2 = true;
                });
            }
        }
    },
    mounted() {
        const store = useAppStore();
        if (!store.token) {
            this.$router.push('/accesUser');
        } else if (store.user?.email != '') {
            this.email = store.user.email;
            const data = {
                email: store.user.email
            }
            getEntradasWithEmail(data, store.token).then((response) => {
                this.tickets2 = response;
                this.showTickets2 = true;
            });
        }
    }
}
</script>