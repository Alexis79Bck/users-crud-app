<template>
    <!-- Mantener como un Link de Inertia para coherencia con la navegación -->
    <Link :href="route('dashboard')" class="brand-link
               rounded-lg  item-center justify-center  
                flex w-100 
               overflow-hidden transition-all duration-300 ease-in-out">
    <!-- Tu componente ApplicationLogo, ahora con las clases de imagen de AdminLTE -->
    <ApplicationLogo class="brand-image bg-white elevation-3 img-circle " style="opacity: .8" />
    <!-- El texto de la marca, controlado por la clase de AdminLTE para colapsar -->
    <span class="brand-text font-weight-bold ml-3 text-neutral-800 
                whitespace-nowrap overflow-hidden text-ellipsis"
                :class="{'hidden': isSidebarCollapsed}">
                {{ appName }}</span>
    </Link>
</template>

<script setup lang="ts">
import { computed, inject } from 'vue';
import { Link } from '@inertiajs/vue3';
import ApplicationLogo from '../../ApplicationLogo.vue';

const appName = computed(() => import.meta.env.APP_LOGO_NAME || 'USERS POSTS'); 
const isSidebarCollapsed = inject<boolean>('sidebarCollapsed', false);
</script>
