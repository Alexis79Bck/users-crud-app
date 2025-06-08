<template>
  <a href="#" class="dropdown-item">
    <i :class="notification.icon + ' mr-2'"></i> {{ notification.title }}
    <span class="float-right text-muted text-sm">{{ notification.time }}</span>
  </a>
</template>

<script setup>
defineProps({
  notification: {
    type: Object,
    required: true
  }
})
</script>