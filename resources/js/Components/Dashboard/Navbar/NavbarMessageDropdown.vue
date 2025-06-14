<template>
    <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#" :class="iconLinkClasses">
            <i class="far fa-comments"></i>
            <BadgeCounter :count="unreadMessagesCount" color-class="badge-danger" />
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <span class="dropdown-header">{{ unreadMessagesCount }} Mensajes no leídos</span>
            <div class="dropdown-divider"></div>

            <AppMessageItem v-for="message in messages.slice(0,3)" :key="message.id" :message="message" />

            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item dropdown-footer">Ver todos los mensajes</a>
        </div>
    </li>
</template>

<script setup lang="ts">
import { computed, onMounted } from 'vue'; // Importamos onMounted y computed
import AppMessageItem from './NavbarMessageItem.vue'; // Asegúrate de que este path sea correcto
import BadgeCounter from '@/Components/UI/BadgeCounter.vue'; // Importamos el BadgeCounter
import { useMessage } from '@/Composables/useMessage'; // Importamos el composable de mensajes

// Usamos el composable para gestionar los mensajes
const { messages, unreadMessagesCount, fetchMessages } = useMessage();

// Propiedad computada para determinar las clases del enlace del icono
// que lo harán cambiar de color si hay mensajes no leídos.
const iconLinkClasses = computed(() => {
    return {
        'text-danger': unreadMessagesCount.value > 0 // Aplica 'text-danger' si hay mensajes no leídos
    };
});

// Cuando el componente se monta, cargamos los mensajes
onMounted(() => {
    fetchMessages();
});
</script>
