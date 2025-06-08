<template>
  <nav class="main-header navbar navbar-expand navbar-lightblue navbar-light">
    <AppNavbarLeft />
    <AppNavbarCenter :app-name="appName" :app-version="appVersion"/>
    <AppNavbarRight />
  </nav>
</template>

<script setup>
import AppNavbarLeft from './Navbar/NavbarLeft.vue'
import AppNavbarCenter from './Navbar/NavbarCenter.vue'
import AppNavbarRight from './Navbar/NavbarRight.vue'

defineProps({
  appName: {
    type: String,
    required: true
  },
  appVersion: {
    type: String,
    required: true
  }
})
</script>