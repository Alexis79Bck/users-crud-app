<script setup>
const props = defineProps({
    src: {
        type: String,
        default: 'assets/images/logo-red-flame.png',
    },
});
</script>

<template>
    <img :src="props.src" alt="Logo" class="w-48 h-48 text-center" />
</template>
