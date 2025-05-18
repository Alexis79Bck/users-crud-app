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
    <img :src="props.src" alt="Logo" class="mt-3 w-50 h-50 text-center" />
</template>
