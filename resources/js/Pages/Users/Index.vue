<template>
    <div class="container mx-auto py-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Usuarios</h1>
            <button
                class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded"
                @click="goToCreate"
            >
                Nuevo Usuario
            </button>
        </div>
        <div class="bg-white shadow rounded-lg overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nombre</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <tr v-for="user in users" :key="user.id">
                        <td class="px-6 py-4 whitespace-nowrap">{{ user.id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ user.name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ user.email }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <button
                                class="text-blue-600 hover:underline mr-3"
                                @click="goToEdit(user.id)"
                            >
                                Editar
                            </button>
                            <button
                                class="text-red-600 hover:underline"
                                @click="deleteUser(user.id)"
                            >
                                Eliminar
                            </button>
                        </td>
                    </tr>
                    <tr v-if="users.length === 0">
                        <td colspan="4" class="px-6 py-4 text-center text-gray-500">No hay usuarios registrados.</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { useRouter } from 'vue-router'

const users = ref([])

const router = useRouter()

const fetchUsers = async () => {
    // Simulación de fetch, reemplaza con tu API real
    users.value = [
        { id: 1, name: 'Juan Pérez', email: 'juan@example.com' },
        { id: 2, name: 'Ana López', email: 'ana@example.com' }
    ]
}

const goToCreate = () => {
    router.push({ name: 'users.create' })
}

const goToEdit = (id) => {
    router.push({ name: 'users.edit', params: { id } })
}

const deleteUser = (id) => {
    if (confirm('¿Seguro que deseas eliminar este usuario?')) {
        users.value = users.value.filter(user => user.id !== id)
        // Aquí deberías llamar a tu API para eliminar el usuario
    }
}

onMounted(fetchUsers)
</script>

<style scoped>
.container {
    max-width: 900px;
}
</style>