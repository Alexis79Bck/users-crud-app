<template>
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <AppSidebarBrand />

    <div class="sidebar">
      <AppSidebarUserPanel />

      <AppSidebarSearchForm />

      <!-- Pasamos los ítems del menú desde el composable -->
      <AppSidebarMenu :menu-items="sidebarMenuItems" :loading="loadingSidebar" :error="errorSidebar" />
    </div>
  </aside>
</template>

<script setup lang="ts">
import AppSidebarBrand from '@/Components/Dashboard/Sidebar/SidebarBrand.vue';
import AppSidebarUserPanel from '@/Components/Dashboard/Sidebar/SidebarUserInfo.vue';
import AppSidebarSearchForm from '@/Components/Dashboard/Sidebar/SidebarSearchForm.vue';
import AppSidebarMenu from '@/Components/Dashboard/Sidebar/SidebarMenu.vue';
import { useSidebar } from '@/Composables/useSidebar';

// Usamos el composable para manejar el estado del sidebar
const { sidebarMenuItems, loadingSidebar, errorSidebar } = useSidebar();
</script>