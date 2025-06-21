<template>
    <li class="nav-item dropdown user-menu">
        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
            <img :src="userAvatar" class="user-image img-circle elevation-2" alt="User Image">
        </a>
        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <li class="d-flex flex-row gap-4 user-header bg-lightblue">

                <img :src="userAvatar" class="img-circle elevation-2" alt="User Image">

                <p>
                    {{ userName }}
                    <small v-if="userRole">{{ userRole }}</small>
                </p>
            </li>
            <li class="user-footer">
                <Link :href="route('profile.edit')" class="btn btn-default btn-flat">Perfil</Link>
                <Link :href="route('logout')" method="post" as="button" class="btn btn-default btn-flat float-right">
                Cerrar Sesión</Link>
            </li>
        </ul>
    </li>
</template>

<script setup lang="ts">
import { computed } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';

// Accedemos al objeto $page de Inertia para obtener las props
const page = usePage();

// Propiedades computadas para acceder a los datos del usuario de forma reactiva
// Estos datos ahora vienen directamente de props.initialPage.props.auth.user inyectados en app.js
const userName = computed(() => page.props.auth.user?.name || 'Invitado');
const userEmail = computed(() => page.props.auth.user?.email || '');
const userRole = computed(() => page.props.auth.user?.role || ''); // Asume que tienes una propiedad 'role' en tu modelo User

// Propiedad computada para la URL del avatar
const userAvatar = computed(() => {
    console.log(page.props.auth.user?.avatar_url);
    
    // Si el usuario tiene una propiedad 'avatar_url' (por ejemplo, generada en el backend)
    if (page.props.auth.user?.avatar_url) {
        return page.props.auth.user.avatar_url;
    }
    // Si no tiene avatar o es nulo, usa una imagen por defecto
    return '/assets/images/default-avatar.png'; // Asegúrate de que esta ruta sea correcta y exista
});
</script>