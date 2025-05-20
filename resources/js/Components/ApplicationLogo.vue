<script setup>
const props = defineProps({
    src: {
        type: String,
        default: 'assets/images/logo-red-flame.png',
    },
});
</script>

<template>
    <img :src="props.src" alt="Logo" class="mt-3 w-40 h-40 text-center" />
</template>
