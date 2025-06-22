<template>
  <div :class="['nav-item', { 'menu-open': isActive }]">
    <a href="#" class="nav-link" :class="{ active: isActive }">
      <i :class="item.icon" class="nav-icon"></i>
      <p>
        {{ item.label }}
        <i class="right fas fa-angle-left"></i>
      </p>
    </a>
    <ul class="nav nav-treeview">
      <li v-for="child in item.children" :key="child.label" class="nav-item">
        <SidebarLink :item="child" :is-active="child.isActive" />
      </li>
    </ul>
  </div>
</template>

<script setup lang="ts">
import { defineProps } from 'vue';
import SidebarLink from './SidebarLink.vue';
import { TreeviewMenuItem } from '@/Types/Sidebar';

defineProps<{
  item: TreeviewMenuItem,
  isActive: boolean
}>();
</script>

<style scoped>
.menu-open > .nav-link {
  background-color: #343a40;
  color: #fff;
}
</style>
