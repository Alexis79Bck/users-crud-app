<template>
  <ul class="navbar-nav">
    <li class="nav-item">
      <a
        class="nav-link"
        data-widget="pushmenu"
        href="#"
        role="button"
        @click.prevent="$emit('toggle')"
      >
        <i class="fas fa-bars"></i>
      </a>
    </li>
  </ul>
</template>

