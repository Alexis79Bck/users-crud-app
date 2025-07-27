<template>
  <ul class="navbar-nav ">
    <!-- Búsqueda rápida -->
    <AppNavbarJumpTo />

    <!-- Mensajes -->
    <AppMessageDropdown />

    <!-- Notificaciones -->
    <AppNotificationDropdown />

    <!-- selector de Tema Claro Oscuro -->
    <ThemeSwitcher />

    <!-- Menú de usuario -->
    <AppUserMenu />
  </ul>
</template>

<script setup>
import AppNavbarJumpTo from './NavbarJumpTo.vue'
import AppMessageDropdown from './NavbarMessageDropdown.vue'
import AppNotificationDropdown from './NavbarNotificationDropdown.vue'
import AppUserMenu from './NavbarUserMenuDropdown.vue'
import ThemeSwitcher from '@/Components/UI/ThemeSwitcher.vue'
</script>