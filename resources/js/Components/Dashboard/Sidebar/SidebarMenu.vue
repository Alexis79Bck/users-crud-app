<template>
  <nav>
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      <li v-for="item in menuItems" :key="item.label" :class="['nav-item', { 'menu-open': isTreeviewOpen(item) }]">
        <component
          :is="item.type === 'treeview' ? 'SidebarTreeview' : 'SidebarLink'"
          :item="item"
          :is-active="isItemActive(item)"
        />
      </li>
    </ul>
  </nav>
</template>

<script setup lang="ts">
import { computed } from 'vue';
import SidebarLink from './SidebarLink.vue';
import SidebarTreeview from './SidebarTreeview.vue';
import { SidebarMenuItem } from '@/Types/Sidebar';

// Props para recibir los ítems del menú, estado de carga y errores
defineProps({
  menuItems: {
    type: Array as () => SidebarMenuItem[],
    required: true,
  },
  loading: {
    type: Boolean,
    default: false,
  },
  error: {
    type: String,
    default: null,
  },
});

// Emitimos eventos para manejar la lógica de activación y apertura
const emit = defineEmits(['update:isActive', 'update:isOpen']);

// Computed para manejar el estado de activación y apertura
const isItemActive = (item: SidebarMenuItem) => item.isActive;
const isTreeviewOpen = (item: SidebarMenuItem) => item.type === 'treeview' && item.isActive;
</script>

<style scoped>
/* Estilos específicos para el menú del sidebar */
.nav-item {
  margin-bottom: 0.5rem;
}
</style>