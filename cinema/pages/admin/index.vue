<template>
    <NuxtLayout name="navbar" />
    <div class="min-h-screen bg-neutral-900">
        <!-- Header Section -->
        <div class="bg-gradient-to-r from-red-900 to-neutral-900 py-12">
            <div class="container mx-auto px-4">
                <h2 class="text-5xl font-bold text-white text-center mb-4">Panel de Administración</h2>
                <p class="text-xl text-gray-300 text-center">Gestiona tu cine de manera eficiente</p>
            </div>
        </div>

        <!-- Admin Cards -->
        <div class="container mx-auto px-4 py-12">
            <div class="grid md:grid-cols-2 gap-8 max-w-4xl mx-auto">
                <!-- Películas Card -->
                <div class="bg-neutral-800 rounded-xl shadow-xl overflow-hidden transform hover:scale-105 transition-all duration-300">
                    <div class="p-6">
                        <div class="flex items-center justify-center mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4v16M17 4v16M3 8h4m10 0h4M3 12h18M3 16h4m10 0h4M4 20h16a1 1 0 001-1V5a1 1 0 00-1-1H4a1 1 0 00-1 1v14a1 1 0 001 1z" />
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-white text-center mb-3">Gestión de Películas</h3>
                        <p class="text-gray-400 text-center mb-6">Administra el catálogo de películas, añade nuevos estrenos y actualiza la información existente.</p>
                        <div class="flex justify-center">
                            <nuxt-link to="/admin/movies" class="inline-flex items-center px-6 py-3 bg-red-600 text-white font-medium rounded-lg hover:bg-red-700 transition-colors duration-300">
                                Administrar Películas
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </nuxt-link>
                        </div>
                    </div>
                </div>

                <!-- Sesiones Card -->
                <div class="bg-neutral-800 rounded-xl shadow-xl overflow-hidden transform hover:scale-105 transition-all duration-300">
                    <div class="p-6">
                        <div class="flex items-center justify-center mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-white text-center mb-3">Gestión de Sesiones</h3>
                        <p class="text-gray-400 text-center mb-6">Programa nuevas sesiones, gestiona horarios y controla el aforo de las salas.</p>
                        <div class="flex justify-center">
                            <nuxt-link to="/admin/sessions" class="inline-flex items-center px-6 py-3 bg-red-600 text-white font-medium rounded-lg hover:bg-red-700 transition-colors duration-300">
                                Administrar Sesiones
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </nuxt-link>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats Section -->
        <div class="bg-neutral-800 py-12 mt-8">
            <div class="container mx-auto px-4">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="text-center">
                        <h4 class="text-4xl font-bold text-red-500">{{ movies?.length || 0 }}</h4>
                        <p class="text-gray-400 mt-2">Películas Activas</p>
                    </div>
                    <div class="text-center">
                        <h4 class="text-4xl font-bold text-red-500">{{ sessions?.length || 0 }}</h4>
                        <p class="text-gray-400 mt-2">Sesiones Programadas</p>
                    </div>
                    <div class="text-center">
                        <h4 class="text-4xl font-bold text-red-500">{{ totalTickets }}</h4>
                        <p class="text-gray-400 mt-2">Entradas Vendidas</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { useAppStore } from '../../store/index';
import { getAllMovies, getAllSessions } from '../../services/communicationManager';

export default {
    data() {
        return {
            movies: [],
            sessions: [],
            totalTickets: 0
        }
    },
    methods: {
        calculateTotalTickets() {
            return this.sessions.reduce((total, session) => total + session.tickets_sold, 0);
        }
    },
    mounted() {
        //const store = useAppStore();
        //if (store.user?.type != 1) {
            //this.$router.push('/');
            //return;
        //}

        // Cargar películas
        getAllMovies(store.token).then(response => {
            this.movies = response;
        }).catch(error => {
            console.error('Error al cargar películas:', error);
        });

        // Cargar sesiones
        getAllSessions().then(response => {
            this.sessions = response;
            this.totalTickets = this.calculateTotalTickets();
        }).catch(error => {
            console.error('Error al cargar sesiones:', error);
        });
    }
}
</script>