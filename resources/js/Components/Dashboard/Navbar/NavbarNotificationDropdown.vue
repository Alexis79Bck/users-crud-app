<template>
    <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#" :class="iconLinkClasses">
            <i class="far fa-bell"></i>
            <!-- Usamos el componente BadgeCounter aquí, pasando el conteo total de notificaciones -->
            <BadgeCounter :count="totalNotificationsCount" color-class="badge-warning" />
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <!-- Encabezado del dropdown que muestra el conteo total de notificaciones -->
            <span class="dropdown-header">{{ totalNotificationsCount }} Notificaciones</span>
            <div class="dropdown-divider"></div>

            <!-- Iteramos sobre las notificaciones cargadas por el composable -->
            <!-- Limitamos a las primeras 3 notificaciones para no desbordar el dropdown -->
            <AppNotificationItem v-for="notif in notifications.slice(0,3)" :key="notif.id" :notification="notif" />

            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item dropdown-footer">Ver todas</a>
        </div>
    </li>
</template>

<script setup lang="ts">
import { computed, onMounted } from 'vue'; // Importamos onMounted y computed
import AppNotificationItem from './NavbarNotificationItem.vue'; // Asegúrate de que este path sea correcto
import BadgeCounter from '@/Components/UI/BadgeCounter.vue'; // Importamos el BadgeCounter
import { useNotification } from '@/Composables/useNotification'; // Importamos el composable de notificaciones
import { Notification } from '@/Types/Notification'; // Importa la interfaz Notification para tipado explícito

// Usamos el composable para gestionar las notificaciones
const { notifications, totalNotificationsCount, fetchNotifications } = useNotification();

// Propiedad computada para determinar las clases del enlace del icono
// que lo harán cambiar de color si hay notificaciones.
const iconLinkClasses = computed(() => {
    return {
        'text-warning': totalNotificationsCount.value > 0 // Aplica 'text-warning' si hay notificaciones
    };
});

// Cuando el componente se monta, cargamos las notificaciones
onMounted(() => {
    fetchNotifications();
});
</script>

<style scoped>
/* Puedes añadir estilos específicos para este componente si es necesario */
</style>