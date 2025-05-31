<template>
  <ul class="navbar-nav ml-auto">
    <AppNavbarSearch />
    <AppMessageDropdown />
    <AppNotificationDropdown />
    <AppNavbarFullscreenButton />
    <AppNavbarControlSidebarButton />
  </ul>
</template>

<script setup>
import AppNavbarSearch from './NavbarSearch.vue'
import AppMessageDropdown from './NavbarMessageDropdown.vue'
import AppNotificationDropdown from './NavbarNotificationDropdown.vue'
import AppNavbarFullscreenButton from './NavbarFullscreenButton.vue'
import AppNavbarControlSidebarButton from './NavbarControlSidebarButton.vue'
</script>