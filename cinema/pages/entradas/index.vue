<template>
    <NuxtLayout name="navbar" /> 
    <div class="bg-blue-950 py-8 min-h-[38.5rem]">
        <div class="container mx-auto">
            <h2 class="text-6xl font-semibold tracking-wider text-center text-white py-2">¡Consulta tus compras!</h2>
            <p class="mt-4 py-3 text-xl text-center text-slate-300">Puedes buscar todos tus registros de compras del CineVilla.</p>
            <div class="m-9">
                <div class="flex justify-center mt-6">
                    <input type="number" v-model="sessionId" placeholder="ID de sesión" class="mr-4 px-4 py-2 rounded-lg border border-gray-400 focus:outline-none focus:border-blue-500">
                    <input type="email" v-model="email" placeholder="Correo electrónico" class="mr-4 px-4 py-2 rounded-lg border border-gray-400 focus:outline-none focus:border-blue-500">
                    <button @click="searchEntradas()"  class="px-4 py-2 bg-blue-500 text-white rounded-lg focus:outline-none hover:bg-blue-600">Buscar</button>
                </div>
                <!-- especificos -->
                <div v-if="showTickets1 && tickets1">
                    <TableListTickets :tickets="tickets1" />
                </div>
                <!-- generales -->
                <div v-if="showTickets2 && tickets2">
                    <TableListTickets :tickets="tickets2" />
                </div>
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
                    console.log(response);
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
                    console.log(response);
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
        } else if ( store.user?.email != '') {
            this.email = store.user.email;
            this.email2 = store.user.email;
            const data = {
                email: store.user.email
            }
            getEntradasWithEmail(data, store.token).then((response) => {
                console.log(response);
                this.tickets2 = response;
                this.showTickets2 = true;
            });
        }   
    }
}
</script>
