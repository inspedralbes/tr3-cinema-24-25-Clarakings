<template>
    <div class="container mx-auto py-8">
        <div class="bg-neutral-800 rounded-xl shadow-xl overflow-hidden">
            <div class="px-6 py-4 border-b border-neutral-700">
                <h2 class="text-2xl font-bold text-white">Historial de Compras</h2>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-neutral-700">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Email</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Nombre</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Apellido</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Teléfono</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Precio</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Asiento</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">ID Sesión</th>
                        </tr>
                    </thead>
                    <tbody class="bg-neutral-800 divide-y divide-neutral-700">
                        <tr v-for="ticket in tickets" :key="ticket.email + ticket.seat"
                            class="hover:bg-neutral-700 transition-colors duration-200">
                            <td class="px-6 py-4 whitespace-nowrap text-gray-300">{{ ticket.email }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-gray-300">{{ ticket.first_name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-gray-300">{{ ticket.last_name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-gray-300">{{ ticket.phone_number }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-gray-300">{{ ticket.price }}€</td>
                            <td class="px-6 py-4 whitespace-nowrap text-gray-300">
                                <span class="px-2 py-1 text-xs font-medium rounded-full"
                                      :class="ticket.seat.includes('VIP') ? 'bg-yellow-500/20 text-yellow-400' : 'bg-blue-500/20 text-blue-400'">
                                    {{ ticket.seat }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-gray-300">{{ ticket.session_id }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Empty State -->
            <div v-if="!tickets || tickets.length === 0" class="p-8 text-center">
                <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                <p class="text-gray-400">No hay registros de compras disponibles</p>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        tickets: Object
    }
}
</script>