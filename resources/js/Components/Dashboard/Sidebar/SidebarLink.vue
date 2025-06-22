<template>
  <a
    v-if="item.as === 'button'"
    :class="['nav-link', { active: isActive }]"
    href="#"
    @click.prevent="$emit('logout')"
  >
    <i :class="item.icon" class="nav-icon"></i>
    <p>{{ item.label }}</p>
  </a>
  <router-link
    v-else
    :to="{ name: item.routeName }"
    :class="['nav-link', { active: isActive }]"
  >
    <i :class="item.icon" class="nav-icon"></i>
    <p>
      {{ item.label }}
      <span v-if="item.badge" :class="['right', 'badge', item.badge.class]">{{ item.badge.text }}</span>
    </p>
  </router-link>
</template>

<script setup lang="ts">
import { defineProps } from 'vue';
import { LinkMenuItem } from '@/Types/Sidebar';

defineProps<{
  item: LinkMenuItem,
  isActive: boolean
}>();
</script>

<style scoped>
.nav-link.active {
  background-color: #007bff;
  color: #fff;
}
</style>
