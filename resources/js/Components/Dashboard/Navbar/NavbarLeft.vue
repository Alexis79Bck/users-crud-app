<template>
  <ul class="navbar-nav">
    <AppNavbarToggler />
    <AppNavbarLink v-for="link in links" :key="link.name" :link="link" />
  </ul>
</template>

<script setup>
import AppNavbarToggler from './NavbarTogglerButton.vue'
import AppNavbarLink from './NavbarLink.vue'

const links = [
  { name: 'Home', url: '/' },
  { name: 'Contact', url: '/contact' }
]
</script>