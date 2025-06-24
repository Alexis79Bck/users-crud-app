<template>
  <a href="#" class="nav-link" :class="{'active': isActive}">
    <i class="nav-icon" :class="item.icon"></i>
    <p>
      {{ item.label }}
      <i class="right fas fa-angle-left"></i>
      <span v-if="item.badge" :class="['badge right', item.badge.class]">{{ item.badge.text }}</span>
    </p>
  </a>
  <ul class="nav nav-treeview">
    <li v-for="(child, childIndex) in item.children" :key="childIndex" class="nav-item">
      <SidebarLink
        v-if="child.type === 'link'"
        :item="child"
        :is-active="child.isActive($page.component)"
      />
      </li>
  </ul>
</template>

<script setup lang="ts">
import { usePage } from '@inertiajs/vue3';
import SidebarLink from './SidebarLink.vue';
// import SidebarTreeview from './SidebarTreeview.vue'; // Para recursividad, descomentar aquí
import { TreeviewMenuItem, SidebarMenuItem } from '@/Types/Sidebar'; // Importa los tipos

// Definición de Props para SidebarTreeview
interface SidebarTreeviewProps {
  item: TreeviewMenuItem; // Este componente solo recibe ítems de tipo 'treeview'
  isActive: boolean; // Si este treeview está actualmente activo (abierto)
}

defineProps<SidebarTreeviewProps>();

const page = usePage(); // Necesario para que los hijos evalúen su propio estado activo
</script>