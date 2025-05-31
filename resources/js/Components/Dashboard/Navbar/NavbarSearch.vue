<template>
    <form @submit.prevent="onSearch" class="navbar-search-form">
        <input
            v-model="query"
            type="text"
            class="navbar-search-input"
            placeholder="Buscar usuarios..."
            aria-label="Buscar"
        />
        <button type="submit" class="navbar-search-btn">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" viewBox="0 0 20 20" fill="currentColor">
                <path
                    fill-rule="evenodd"
                    d="M12.9 14.32a8 8 0 111.41-1.41l4.38 4.37a1 1 0 01-1.42 1.42l-4.37-4.38zm-5.9-6.32a5 5 0 1110 0 5 5 0 01-10 0z"
                    clip-rule="evenodd"
                />
            </svg>
        </button>
    </form>
</template>

<script setup>
import { ref, defineEmits } from 'vue'

const query = ref('')
const emit = defineEmits(['search'])

function onSearch() {
    emit('search', query.value.trim())
}
</script>

<style scoped>
.navbar-search-form {
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.navbar-search-input {
    padding: 0.4rem 0.8rem;
    border: 1px solid #d1d5db;
    border-radius: 4px;
    font-size: 1rem;
    outline: none;
    transition: border-color 0.2s;
}

.navbar-search-input:focus {
    border-color: #2563eb;
}

.navbar-search-btn {
    background: none;
    border: none;
    padding: 0.3rem;
    cursor: pointer;
    color: #374151;
    display: flex;
    align-items: center;
}

.navbar-search-btn .icon {
    width: 1.2em;
    height: 1.2em;
}
</style>