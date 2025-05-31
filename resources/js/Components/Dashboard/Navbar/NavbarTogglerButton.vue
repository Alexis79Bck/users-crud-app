<template>
  <li class="nav-item">
    <a
      class="nav-link"
      data-widget="pushmenu"
      href="#"
      role="button"
      @click.prevent="sidebarStore.toggle()"
    >
      <i class="fas fa-bars"></i>
    </a>
  </li>
</template>

<script setup>
import { useSidebarStore } from '@/stores/sidebarStore'

const sidebarStore = useSidebarStore()
</script>