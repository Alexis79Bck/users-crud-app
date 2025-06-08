<template>
    <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-bell"></i>
            <span class="badge badge-warning navbar-badge">{{ notifications.length }}</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <span class="dropdown-header">{{ notifications.length }} Notificaciones</span>
            <div class="dropdown-divider"></div>
            <AppNotificationItem v-for="notif in notifications" :key="notif.id" :notification="notif" />
            <a href="#" class="dropdown-item dropdown-footer">Ver todas</a>
        </div>
    </li>
</template>

<script setup>
import { ref } from 'vue'
import AppNotificationItem from './NavbarNotificationItem.vue'

const notifications = ref([
    { id: 1, icon: 'fas fa-envelope', title: '4 nuevos mensajes', time: '3 mins' },
    { id: 2, icon: 'fas fa-users', title: '8 solicitudes', time: '12 horas' },
    { id: 3, icon: 'fas fa-file', title: '3 informes nuevos', time: '2 días' }
])
</script>