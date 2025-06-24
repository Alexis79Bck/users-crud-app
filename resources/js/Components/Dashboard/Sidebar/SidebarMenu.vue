<template>
  <nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      <li v-if="loading" class="nav-item text-center text-muted py-2">
        Cargando menú...
      </li>
      <li v-else-if="error" class="nav-item text-center text-danger py-2">
        {{ error }}
      </li>
      <template v-else>
        <template v-for="item in menuItems" :key="item.label">
          <li v-if="item.type === 'header'" class="nav-header">
            {{ item.label }}
          </li>

          <li v-else
              :class="['nav-item', { 'menu-open': item.type === 'treeview' && isTreeviewOpen(item as TreeviewMenuItem) }]"
          >
            <component
              :is="item.type === 'treeview' ? SidebarTreeview : SidebarLink"
              :item="item.type === 'treeview' ? (item as TreeviewMenuItem) : (item as LinkMenuItem)"
              :is-active="isItemActive(item)"
            />
          </li>
        </template>
      </template>
    </ul>
  </nav>
</template>

<script setup lang="ts">
import SidebarLink from './SidebarLink.vue';
import SidebarTreeview from './SidebarTreeview.vue';
import { SidebarMenuItem, TreeviewMenuItem, LinkMenuItem } from '@/Types/Sidebar'; // Asegúrate de importar TreeviewMenuItem

// Definición de Props para AppSidebarMenu
interface AppSidebarMenuProps {
  menuItems: SidebarMenuItem[];
  loading?: boolean;
  error?: string | null;
  isItemActive: (item: SidebarMenuItem) => boolean;
  isTreeviewOpen: (item: TreeviewMenuItem) => boolean;
}

const props = withDefaults(defineProps<AppSidebarMenuProps>(), {
  loading: false,
  error: null,
  isItemActive: () => (item: SidebarMenuItem) => false, // Default function
  isTreeviewOpen: () => (item: TreeviewMenuItem) => false, // Default function
});
</script>

<style scoped>
/* Las clases de AdminLTE manejan la mayoría de estilos,
   pero puedes añadir personalizaciones aquí si es necesario. */
.nav-item {
  margin-bottom: 0.2rem; /* Ajuste ligero para estética */
}
/* AdminLTE ya tiene .nav-header con buenos estilos, pero si quieres override: */
.nav-header {
  font-weight: bold;
  color: #adb5bd;
  padding: 0.5rem 1rem 0.25rem 1rem;
  font-size: 0.8rem; /* Ligeramente más pequeño para encabezados */
  letter-spacing: 0.8px;
  text-transform: uppercase;
}
</style>