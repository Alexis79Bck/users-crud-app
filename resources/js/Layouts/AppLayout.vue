<template>
  <div class="wrapper">
    <AppNavbar />
    <AppSidebar />
    <div class="content-wrapper">
      <AppHeader />
      <AppMainContent />
    </div>
    <AppFooter />
    <AppControlSidebar />
  </div>
</template>

<script setup>
import AppNavbar from '@/Components/Dashboard/Navbar.vue'
import AppSidebar from '@/Components/Dashboard/Sidebar.vue'
import AppHeader from '@/Components/Dashboard/Header.vue'
import AppMainContent from '@/Components/Dashboard/MainContent.vue'
import AppFooter from '@/Components/Dashboard/Footer.vue'
import AppControlSidebar from '@/Components/Dashboard/ControlSidebar.vue'
</script>