<template>
  <ul class="navbar-nav ml-auto">
    <!-- Búsqueda rápida -->
    <AppNavbarJumpTo />

    <!-- Mensajes -->
    <AppMessageDropdown />

    <!-- Notificaciones -->
    <AppNotificationDropdown />

    <!-- Menú de usuario -->
    <AppUserMenu />
  </ul>
</template>

<script setup>
import AppNavbarJumpTo from './NavbarJumpTo.vue'
import AppMessageDropdown from './NavbarMessageDropdown.vue'
import AppNotificationDropdown from './NavbarNotificationDropdown.vue'
import AppUserMenu from './NavbarUserMenuDropdown.vue'
</script>