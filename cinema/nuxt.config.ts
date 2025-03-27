// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  devtools: { enabled: true },
  modules: ["@nuxtjs/tailwindcss", '@pinia/nuxt'],
  ssr: false,
  vite: {
    optimizeDeps: {
      include: ['socket.io-client']
    }
  }
  
})