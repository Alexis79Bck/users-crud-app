<script setup>
import { defineProps } from 'vue';


const props = defineProps({
    src: {
        type: String,
        default: 'assets/images/logo-red-flame.png',
    },
});
</script>

<template>
    <img :src="props.src" alt="Logo" class="w-40 h-40 fill-current" />
</template>
