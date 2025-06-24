<template>
  <aside class="main-sidebar bg-lightblue sidebar-light-primary elevation-4">
    <SidebarBrand />

    <div class="sidebar">
      <!-- <SidebarUserInfo />

      <SidebarSearchForm /> -->

      <SidebarMenu
        :menu-items="sidebarMenuItems"
        :loading="loadingSidebar"
        :error="errorSidebar"
        :is-item-active="isItemActive"
        :is-treeview-open="isTreeviewOpen"
      />
    </div>
    </aside>
</template>

<script setup lang="ts">
import SidebarBrand from '@/Components/Dashboard/Sidebar/SidebarBrand.vue';
import SidebarUserInfo from '@/Components/Dashboard/Sidebar/SidebarUserInfo.vue';
import SidebarSearchForm from '@/Components/Dashboard/Sidebar/SidebarSearchForm.vue';
import SidebarMenu from '@/Components/Dashboard/Sidebar/SidebarMenu.vue';
import { useSidebar } from '@/Composables/useSidebar';

// Obtenemos los ítems del menú y la lógica de activación del composable
const { sidebarMenuItems, loadingSidebar, errorSidebar, isItemActive, isTreeviewOpen } = useSidebar();
</script>