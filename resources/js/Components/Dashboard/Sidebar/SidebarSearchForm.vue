<template>
    <form @submit.prevent="onSearch" class="sidebar-search-form">
        <input
            v-model="searchQuery"
            type="text"
            class="sidebar-search-input"
            placeholder="Buscar..."
            aria-label="Buscar"
        />
        <button type="submit" class="sidebar-search-button">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" viewBox="0 0 20 20" fill="currentColor">
                <path
                    fill-rule="evenodd"
                    d="M12.9 14.32a8 8 0 111.414-1.414l4.387 4.387a1 1 0 01-1.414 1.414l-4.387-4.387zM14 8a6 6 0 11-12 0 6 6 0 0112 0z"
                    clip-rule="evenodd"
                />
            </svg>
        </button>
    </form>
</template>

<script setup>
import { ref, defineEmits } from 'vue'

const emit = defineEmits(['search'])
const searchQuery = ref('')

function onSearch() {
    emit('search', searchQuery.value.trim())
}
</script>

<style scoped>
.sidebar-search-form {
    display: flex;
    align-items: center;
    padding: 0.5rem;
}

.sidebar-search-input {
    flex: 1;
    padding: 0.5rem;
    border: 1px solid #e5e7eb;
    border-radius: 4px 0 0 4px;
    outline: none;
}

.sidebar-search-button {
    background: #f3f4f6;
    border: 1px solid #e5e7eb;
    border-left: none;
    border-radius: 0 4px 4px 0;
    padding: 0.5rem 0.75rem;
    cursor: pointer;
    display: flex;
    align-items: center;
}

.sidebar-search-button .icon {
    width: 1rem;
    height: 1rem;
    color: #6b7280;
}
</style>