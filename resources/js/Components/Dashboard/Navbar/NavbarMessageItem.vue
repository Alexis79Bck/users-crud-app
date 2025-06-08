<template>
    <a href="#" class="dropdown-item">
        <div class="media">
            <img :src="message.avatar" alt="User Avatar" class="img-size-50 mr-3 img-circle">
            <div class="media-body">
                <h3 class="dropdown-item-title">
                    {{ message.name }}
                    <span v-if="message.unread" class="float-right text-sm text-danger">
                        <i class="fas fa-star"></i>
                    </span>
                </h3>
                <p class="text-sm">{{ message.text }}</p>
                <p class="text-sm text-muted">
                    <i class="far fa-clock mr-1"></i> {{ message.time }}
                </p>
            </div>
        </div>
    </a>
</template>

<script setup>
defineProps({
    message: {
        type: Object,
        required: true
    }
})
</script>