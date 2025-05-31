<template>
  <li class="nav-item d-none d-sm-inline-block">
    <a :href="link.url" class="nav-link">{{ link.name }}</a>
  </li>
</template>

<script setup>
defineProps({
  link: {
    type: Object,
    required: true,
    validator: (value) => 'name' in value && 'url' in value
  }
})
</script>