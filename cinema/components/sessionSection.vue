<template>
    <div v-show="showSession" class="flex-column m-9 text-center justify-center items-center bg-blue-950">
        <h2 class="text-5xl font-bold text-white p-8">Próxima Sesion</h2>
        <SessionCard :session="session" />
    </div>
    <div v-show="!showSession" class="bg-blue-950 p-4">
        <h3 class="text-4xl font-bold text-center text-white">Próximamente se añadirán sesiones para tu película favorita</h3>
    </div>
</template>

<script>
import { getSessionByMovieId } from '../services/communicationManager';
import { useAppStore } from '../store/index';

export default {
    props: {
        id_movie: String
    },
    data() {
        return {
            session: {},
            id_movieSession: Number,
            showSession: false
        };
    },
    methods: {
    },
    mounted() {
        if (this.id_movie != undefined) {
            const store = useAppStore();
            // Llamada a la API para obtener la sesión
            let id = parseInt(this.id_movie);
            getSessionByMovieId(id).then((response) => {
                // id_session, day, hour, movie_id, total_tickets, tickets_sold
                this.session = response;
                this.id_movieSession = response.movie_id;
                store.setSession(response);
                store.setSessionId(parseInt(response.id_session));
                this.showSession = true;
            }).catch((error) => {
                console.error(error);
            });
        } else {
            console.error("El parámetro id no está definido");
        }
    }
};
</script>