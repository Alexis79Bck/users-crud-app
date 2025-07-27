<template>
    <div class="navbar-brand mx-auto">
       <p class="lead h4  font-weight-bold text-lg "> {{ appName }} - {{ appVersion }}</p>
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