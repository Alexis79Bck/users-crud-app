<template>
  <Link
    :href="item.routeName ? route(item.routeName) : (item.href || '#')"
    :method="item.method || 'get'"
    :as="item.as || 'a'"
    :class="['nav-link', { 'active': isActive }]"
  >
    <i class="nav-icon" :class="item.icon"></i>
    <p>
      {{ item.label }}
      <span v-if="item.badge" :class="['right badge', item.badge.class]">{{ item.badge.text }}</span>
    </p>
  </Link>
</template>

<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { LinkMenuItem } from '@/Types/Sidebar'; // Importa el tipo específico para enlaces

// Definición de Props para SidebarLink
interface SidebarLinkProps {
  item: LinkMenuItem; // Este componente solo recibe ítems de tipo 'link'
  isActive: boolean; // Si este ítem está actualmente activo
}

defineProps<SidebarLinkProps>();
</script>