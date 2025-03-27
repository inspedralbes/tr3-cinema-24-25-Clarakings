<template>
    <div class="relative bg-neutral-900 overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23FFF' fill-opacity='0.4'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
        </div>

        <!-- Content -->
        <div class="relative py-16 px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <!-- Logo Animation -->
                <div class="mb-8 transform hover:scale-105 transition-transform duration-300">
                    <h1 class="text-7xl sm:text-8xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-red-600 to-red-400">
                        KingsCinema
                    </h1>
                </div>

                <!-- Tagline -->
                <p class="mt-6 text-xl sm:text-2xl text-gray-300 font-light max-w-3xl mx-auto leading-relaxed">
                    Disfruta del mejor cine en tu ciudad con una experiencia única e inolvidable
                </p>

                <!-- Features -->
                <div class="mt-12 grid grid-cols-1 sm:grid-cols-3 gap-8 max-w-5xl mx-auto">
                    <div class="p-6 bg-neutral-800 rounded-xl shadow-lg transform hover:scale-105 transition-all duration-300">
                        <div class="text-red-500 mb-4">
                            <svg class="w-10 h-10 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-white">Reserva Online</h3>
                        <p class="mt-2 text-gray-400">Compra tus entradas de forma fácil y segura</p>
                    </div>

                    <div class="p-6 bg-neutral-800 rounded-xl shadow-lg transform hover:scale-105 transition-all duration-300">
                        <div class="text-red-500 mb-4">
                            <svg class="w-10 h-10 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M7 4v16M17 4v16M3 8h4m10 0h4M3 12h18M3 16h4m10 0h4M4 20h16a1 1 0 001-1V5a1 1 0 00-1-1H4a1 1 0 00-1 1v14a1 1 0 001 1z"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-white">Últimos Estrenos</h3>
                        <p class="mt-2 text-gray-400">Las mejores películas del momento</p>
                    </div>

                    <div class="p-6 bg-neutral-800 rounded-xl shadow-lg transform hover:scale-105 transition-all duration-300">
                        <div class="text-red-500 mb-4">
                            <svg class="w-10 h-10 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-white">Experiencia VIP</h3>
                        <p class="mt-2 text-gray-400">Disfruta del máximo confort en nuestras salas</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>