<template>
  <div class="wrapper">
    <AppNavbar :app-name="appName" :app-version="appVersion" />
    <!-- <AppSidebar /> -->
    <AppSidebar />
    <div class="content-wrapper">
      <!-- <AppHeader /> -->
      <!-- <AppMainContent /> -->
    </div>
    <!-- <AppFooter /> -->
  </div>
</template>

<script setup>
import { ref } from 'vue'

import AppNavbar from '@/Components/Dashboard/Navbar.vue'
import AppSidebar from '@/Components/Dashboard/Sidebar.vue'
// import AppHeader from '@/Components/Dashboard/Header.vue'
//import AppMainContent from '@/Components/Dashboard/MainContent.vue'
//import AppFooter from '@/Components/Dashboard/Footer.vue'

const appName = ref(window.config?.appName || 'App Demo')
const appVersion = ref(window.config?.appVersion || 'v0.0.1_beta')


</script>