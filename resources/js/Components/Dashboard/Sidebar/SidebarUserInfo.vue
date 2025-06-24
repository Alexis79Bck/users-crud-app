<script setup>
import { ref } from 'vue'

// Simulación de datos de usuario, reemplaza con props o store si es necesario
const user = ref({
    name: 'Juan Pérez',
    email: 'juan.perez@email.com',
    avatar: 'https://ui-avatars.com/api/?name=Juan+Pérez'
})
</script>

<template>
    <div class="sidebar-user-info flex items-center space-x-3 p-4 border-b">
        <img
            :src="user.avatar"
            alt="Avatar"
            class="w-12 h-12 rounded-full object-cover border"
        />
        <div>
            <div class="font-semibold text-gray-800">{{ user.name }}</div>
            <div class="text-sm text-gray-500">{{ user.email }}</div>
        </div>
    </div>
</template>

<style scoped>
.sidebar-user-info {
    background: #f9fafb;
}
</style>