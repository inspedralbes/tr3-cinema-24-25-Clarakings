<template>
    <div class="bg-neutral-900">
            <div class="max-w-2xl mx-auto">
                <SessionCard :session="session" />
            </div>
        
        
        <div v-show="!showSession" class="container mx-auto px-4 py-16">
            <div class="bg-neutral-800 rounded-xl p-8 text-center">
                <svg class="w-16 h-16 text-red-500 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                          d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <h3 class="text-2xl font-bold text-white mb-2">Próximamente</h3>
                <p class="text-gray-400">Muy pronto añadiremos nuevas sesiones para esta película.</p>
            </div>
        </div>
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
    mounted() {
        if (this.id_movie != undefined) {
            const store = useAppStore();
            let id = parseInt(this.id_movie);
            getSessionByMovieId(id).then((response) => {
                this.session = response;
                this.id_movieSession = response.movie_id;
                store.setSession(response);
                store.setSessionId(parseInt(response.id_session));
                this.showSession = true;
            }).catch((error) => {
                console.error(error);
            });
        }
    }
};
</script>