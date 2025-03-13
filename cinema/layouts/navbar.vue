<template>
  <nav class="bg-neutral-900 border-b border-neutral-800">
    <div class="container mx-auto px-4">
      <div class="flex justify-between items-center h-16">
        <!-- Logo -->
        <nuxt-link to="/" class="text-red-600 text-2xl font-bold hover:text-red-500 transition-colors duration-300">
          CinesKings
        </nuxt-link>

        <!-- Botón móvil -->
        <button @click="toggleMenu" class="lg:hidden text-white focus:outline-none">
          <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path v-if="!showMenu" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
            <path v-else stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
          </svg>
        </button>

        <!-- Enlaces de navegación -->
        <div :class="menuClasses" class="lg:flex lg:items-center">
          <nuxt-link to="/" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium transition-colors duration-300">
            Cartelera
          </nuxt-link>
          <nuxt-link to="/sessions/" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium transition-colors duration-300">
            Sesiones
          </nuxt-link>
          <nuxt-link v-if="!userExist" to="/accesUser" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium transition-colors duration-300">
            Iniciar Sesión
          </nuxt-link>
          <div v-else class="flex items-center space-x-4">
            <nuxt-link to="/entradas/" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium transition-colors duration-300">
              Mis Entradas
            </nuxt-link>
            <nuxt-link v-if="userAdmin" to="/admin/" class="text-gray-300 hover:text-white px-3 py-2 rounded-md text-sm font-medium transition-colors duration-300">
              Administración
            </nuxt-link>
            <button @click="postLogoutFetch()" class="bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700 transition-colors duration-300">
              Cerrar Sesión
            </button>
          </div>
        </div>
      </div>
    </div>
  </nav>
</template>

<script>
import { useAppStore } from '../store/index';
import { postLogout } from '../services/communicationManager';

export default {
  data() {
    return {
      showMenu: false,
      userExist: false,
      userAdmin: false
    }
  },
  methods: {
    toggleMenu() {
      this.showMenu = !this.showMenu;
    },
    postLogoutFetch() {
      const store = useAppStore();
      postLogout(store.token);
      store.token = '';
      this.$router.push('/');
    }
  },
  computed: {
    menuClasses() {
      return {
        'hidden': !this.showMenu,
        'lg:flex': true,
        'flex-col': true,
        'lg:flex-row': true,
        'items-center': true,
        'w-full': true,
        'lg:w-auto': true,
        'text-center': true,
        'space-y-4': true,
        'lg:space-y-0': true,
        'lg:space-x-4': true,
        'py-4': true,
        'lg:py-0': true
      };
    }
  },
  mounted() {
    setInterval(() => {
      const store = useAppStore();
      this.userExist = store.token != '';
      this.userAdmin = store.user?.type == 1;
    }, 250);
  }
}
</script>