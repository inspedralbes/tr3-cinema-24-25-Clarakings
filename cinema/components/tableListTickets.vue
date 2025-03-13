<template>
    <div class="container mx-auto py-8">
        <h2 class="text-2xl font-semibold mb-4 text-center text-white">Registros de compras:</h2>
        <div class="overflow-x-auto">
            <table class="table-auto w-full border-collapse border border-gray-200">
                <thead>
                    <tr>
                        <th class="px-4 py-2 bg-gray-100 border border-gray-200">Email</th>
                        <th class="px-4 py-2 bg-gray-100 border border-gray-200">Nombre</th>
                        <th class="px-4 py-2 bg-gray-100 border border-gray-200">Apellido</th>
                        <th class="px-4 py-2 bg-gray-100 border border-gray-200">Teléfono</th>
                        <th class="px-4 py-2 bg-gray-100 border border-gray-200">Precio</th>
                        <th class="px-4 py-2 bg-gray-100 border border-gray-200">Asiento</th>
                        <th class="px-4 py-2 bg-gray-100 border border-gray-200">ID de Sesión</th>
                    </tr>
                </thead>
                <tbody class="text-white text-center">
                    <tr v-for="ticket in tickets">
                        <td class="px-4 py-2 border border-gray-200">{{ ticket.email }}</td>
                        <td class="px-4 py-2 border border-gray-200">{{ ticket.first_name }}</td>
                        <td class="px-4 py-2 border border-gray-200">{{ ticket.last_name }}</td>
                        <td class="px-4 py-2 border border-gray-200">{{ ticket.phone_number }}</td>
                        <td class="px-4 py-2 border border-gray-200">{{ ticket.price }}</td>
                        <td class="px-4 py-2 border border-gray-200">{{ ticket.seat }}</td>
                        <td class="px-4 py-2 border border-gray-200">{{ ticket.session_id }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        tickets: Object // Aquí recibes los registros del componente padre
    }
}
</script>

<style>
/* Aquí puedes agregar estilos adicionales si es necesario */
</style>