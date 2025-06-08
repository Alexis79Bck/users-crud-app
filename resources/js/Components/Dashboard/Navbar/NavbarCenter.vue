<template>
    <div class="navbar-brand mx-auto font-weight-bold text-lg">
       <p class="lead h3 text-navy color-palette"> {{ appName }} - {{ appVersion }}</p>
    </div>
</template>

<script setup>
defineProps({
    appName: {
        type: String,
        required: true
    },
    appVersion: {
        type: String,
        required: true
    }
})
</script>