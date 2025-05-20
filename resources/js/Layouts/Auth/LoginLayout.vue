<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-[url(/assets/images/background_02.jpg)] bg-origin-border bg-no-repeat bg-center bg-cover">
        <ApplicationLogo />
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 border border-2 border-indigo-300 bg-indigo-600 shadow-lg overflow-hidden sm:rounded-lg">
            <slot />
        </div>
    </div>
</template>

<style lang="css" scoped>
    .bg-login-background {
        background-image: url('/public/assets/images/background_02.jpg');
        background-size: cover;
        background-position: center;
    }
    .bg-login-background::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: transparent;
    }
    
</style>
