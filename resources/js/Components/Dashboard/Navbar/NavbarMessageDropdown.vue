<template>
    <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-comments"></i>
            <span class="badge badge-danger navbar-badge">{{ messages.length }}</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <AppMessageItem v-for="message in messages" :key="message.id" :message="message" />
            <a href="#" class="dropdown-item dropdown-footer">Ver todos los mensajes</a>
        </div>
    </li>
</template>

<script setup>
import { ref } from 'vue'
import AppMessageItem from './NavbarMessageItem.vue'

const messages = ref([
    {
        id: 1,
        name: 'Brad Diesel',
        avatar: 'dist/img/user1-128x128.jpg',
        text: 'Llámame cuando puedas...',
        time: '4 Horas',
        unread: true
    },
    {
        id: 2,
        name: 'John Pierce',
        avatar: 'dist/img/user8-128x128.jpg',
        text: 'Recibí tu mensaje',
        time: '4 Horas',
        unread: false
    }
])
</script>