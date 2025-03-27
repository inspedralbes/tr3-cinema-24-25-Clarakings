<template>
    <div class="bg-neutral-900 py-8">
        <div class="container mx-auto px-4">
            <h1 class="text-3xl font-bold text-white text-center mb-8">Selección de Asientos</h1>
            
            <div class="max-w-4xl mx-auto bg-neutral-800 rounded-xl p-6 shadow-xl">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6">
                    <div class="flex items-center justify-center space-x-3">
                        <Seat class="fill-green-400"/>
                        <span class="text-gray-300 font-medium">Seleccionado</span>
                    </div>
                    <div class="flex items-center justify-center space-x-3">
                        <Seat class="fill-orange-100"/>
                        <span class="text-gray-300 font-medium">Reservado</span>
                    </div>
                    <div class="flex items-center justify-center space-x-3">
                        <Seat class="fill-gray-300"/>
                        <span class="text-gray-300 font-medium">Disponible</span>
                    </div>
                    <div class="flex items-center justify-center space-x-3">
                        <Seat class="fill-red-500"/>
                        <span class="text-gray-300 font-medium">Ocupado</span>
                    </div>
                    <div class="flex items-center justify-center space-x-3">
                        <Seat class="fill-yellow-400"/>
                        <span class="text-gray-300 font-medium">VIP</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>