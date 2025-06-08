<template>
  <li class="nav-item">
    <a class="nav-link" data-widget="navbar-search" href="#" role="button">
      <i class="fas fa-search"></i>
    </a>
    <div class="navbar-search-block">
      <form class="form-inline" @submit.prevent="handleSearch">
        <div class="input-group input-group-sm">
          <input
            v-model="searchQuery"
            class="form-control form-control-navbar"
            type="search"
            placeholder="Jump to..."
            aria-label="Jump"
          >
          <div class="input-group-append">
            <button class="btn btn-navbar" type="submit">
              <i class="fas fa-arrow-right"></i>
            </button>
            <button class="btn btn-navbar" type="button" data-widget="navbar-search">
              <i class="fas fa-times"></i>
            </button>
          </div>
        </div>
      </form>
    </div>
  </li>
</template>

<script setup>
import { ref } from 'vue'

const searchQuery = ref('')

const handleSearch = () => {
  // Aquí puedes:
  // - Buscar en el menú del sidebar
  // - Usar router.push() si usas vue-router
  console.log('Buscando:', searchQuery.value)
}
</script>