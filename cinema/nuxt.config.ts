// https://nuxt.com/docs/api/configuration/nuxt-config
export default defineNuxtConfig({
  devtools: { enabled: true },
  modules: ["@nuxtjs/tailwindcss", '@pinia/nuxt'],
  ssr: false,
  axios: {
    proxy: true,
    credentials: false
  },
  proxy: {
    '/api/': {
      target: 'http://localhost:8001/',
      pathRewrite: { '^/api/': '' }
    }
  },
})