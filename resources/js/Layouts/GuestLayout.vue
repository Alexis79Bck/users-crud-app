<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Head, Link } from '@inertiajs/vue3';
</script>

<template>
    
    <div class="hold-transition login-page">
        <div>
           
            <ApplicationLogo class="avatar" />
            
        </div>

        <div
            class="w-100"
        >
            <slot />
        </div>
    </div>
</template>
