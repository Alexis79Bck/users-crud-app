<template>
  <!-- El badge en sí mismo. Solo se renderiza si count > 0 -->
  <span v-if="count > 0" class="badge navbar-badge" :class="badgeClass">
    {{ count }}
  </span>
</template>

<script setup lang="ts">
import { computed } from 'vue';

const props = defineProps({
  /**
   * El número de elementos (mensajes, notificaciones) para mostrar en el badge.
   * Si es 0, el badge no se renderizará.
   */
  count: {
    type: Number,
    required: true,
    default: 0
  },
  /**
   * Clase de color para el badge (ej. 'badge-danger', 'badge-warning').
   * AdminLTE usa clases como 'badge-danger', 'badge-warning', 'badge-info', etc.
   */
  colorClass: { // Cambié a colorClass para ser más descriptivo del color de la clase
    type: String,
    default: 'badge-info' // Un color por defecto si no se especifica
  }
});

// Clases dinámicas para el span del badge
const badgeClass = computed(() => {
  return {
    [props.colorClass]: true // Aplica la clase de color especificada
  };
});
</script>