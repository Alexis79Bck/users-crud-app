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
import AppNavbar from '@/components/Dashboard/Navbar.vue'
import AppSidebar from '@/components/Dashboard/Sidebar.vue'
import AppHeader from '@/components/Dashboard/Header.vue'
import AppMainContent from '@/components/Dashboard/MainContent.vue'
import AppFooter from '@/components/Dashboard/Footer.vue'
import AppControlSidebar from '@/components/Dashboard/ControlSidebar.vue'
</script>