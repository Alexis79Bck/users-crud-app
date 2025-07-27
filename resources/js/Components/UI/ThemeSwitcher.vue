<template>
  <li class="nav-item dropdown">
    <a class="nav-link" data-toggle="dropdown" href="#" >
      <i class="fas fa-palette"></i>
    </a>
    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
      <span class="dropdown-header">Seleccione un Tema</span>
      <div class="dropdown-divider"></div>

      <a v-for="theme in themeOptions" :key="theme.id" href="#" class="dropdown-item"
        :class="{ active: selectedThemeId === theme.id }" @click.prevent="selectTheme(theme.id)">
        <i class="fas fa-circle mr-2" :style="{ color: theme.previewColor }"></i>
        {{ theme.name }}
      </a>

    </div>
  </li>

</template>

<script setup>
import { ref, onMounted, onBeforeUnmount } from 'vue';

// --- OPCIONES DE TEMA ---
// Usaremos 'id' para identificar el tema principal y mapear a nuestras clases CSS
const themeOptions = [
  { id: 'system', name: 'Sistema (Auto)', previewColor: '#666' }, // black-pearl / dr-white
  { id: 'serenity-natural-light', name: 'Serenidad Natural', mode: 'light', previewColor: '#F5F5F5' },
  { id: 'serenity-natural-dark', name: 'Serenidad Natural', mode: 'dark', previewColor: '#181F20' },
  { id: 'warm-dusk-light', name: 'Atardecer Cálido', mode: 'light', previewColor: '#F8F1E9' },
  { id: 'warm-dusk-dark', name: 'Atardecer Cálido', mode: 'dark', previewColor: '#362B32' },
  { id: 'deep-space-light', name: 'Espacio Profundo', mode: 'light', previewColor: '#F0F3F4' },
  { id: 'deep-space-dark', name: 'Espacio Profundo', mode: 'dark', previewColor: '#0A1A23' },
];

// Estado reactivo para el tema seleccionado por el usuario (solo el ID del tema principal)
const selectedThemeId = ref('system');

// Media Query para detectar la preferencia de color del SO
const osPrefersDark = window.matchMedia('(prefers-color-scheme: dark)');

/**
 * Aplica las clases CSS al elemento <html> según el tema seleccionado.
 * @param {string} themeId - El ID del tema principal ('system', 'serenity-natural', etc.).
 * @param {boolean} isInitialLoad - True si es la carga inicial para evitar transiciones.
 */
function applyThemeToHtml(themeId, isInitialLoad = false) {
  const htmlElement = document.documentElement;

  // Deshabilita temporalmente las transiciones para un cambio de tema suave sin "flashes".
  if (!isInitialLoad) {
    htmlElement.classList.add('no-transition');
  }

  // Limpia TODAS las posibles clases de tema personalizadas de la etiqueta <html>.
  // Esto es vital para asegurar que solo una clase de tema esté activa.
  const allPossibleThemeClasses = themeOptions
    .filter(t => t.id !== 'system') // Excluye 'system' porque no añade clase CSS
    .map(t => `theme-${t.id}`); // Genera 'theme-serenity-natural-light', 'theme-warm-dusk-dark', etc.

  htmlElement.classList.remove(...allPossibleThemeClasses);

  // También limpia cualquier clase 'dark-mode' o 'light-mode' que AdminLTE o JS pudieran haber añadido,
  // para evitar conflictos de especificidad o comportamiento no deseado.
  htmlElement.classList.remove('dark-mode', 'light-mode');

  if (themeId !== 'system') {
    // Para temas personalizados, el `themeId` ya es el identificador completo
    // (ej., 'serenity-natural-light'). Solo le añadimos el prefijo 'theme-'.
    htmlElement.classList.add(`theme-${themeId}`);
  }
  // Si themeId es 'system', no añadimos ninguna clase específica, confiamos en `:root` y `light-dark()`
  // para que el SO controle los colores.

  // Después de un breve retardo, re-habilita las transiciones.
  if (!isInitialLoad) {
    requestAnimationFrame(() => {
        requestAnimationFrame(() => {
            htmlElement.classList.remove('no-transition');
        });
    });
  }

  // Guarda la preferencia del tema completo en localStorage para persistencia.
  localStorage.setItem('selected-theme', themeId);
}

/**
 * Lógica cuando el usuario selecciona un tema del dropdown.
 * @param {string} themeId - El ID del tema seleccionado.
 */
function selectTheme(themeId) {
  selectedThemeId.value = themeId; // Actualiza el estado reactivo
  applyThemeToHtml(themeId); // Aplica el tema al HTML
  // El cierre del dropdown es manejado por data-toggle="dropdown" de AdminLTE/Bootstrap.
}

// =============================================================================
// Lógica de Inicialización y Observación de Cambios del Sistema
// =============================================================================

onMounted(() => {
  // 1. Recupera la preferencia del tema de localStorage.
  const savedTheme = localStorage.getItem('selected-theme');

  // 2. Establece el tema inicial del componente.
  // Verifica que el tema guardado sea una opción válida antes de aplicarlo.
  if (savedTheme && themeOptions.some(t => t.id === savedTheme)) {
    selectedThemeId.value = savedTheme;
  } else {
    selectedThemeId.value = 'system'; // Por defecto, si no hay preferencia o es inválida
  }

  // 3. Aplica las clases CSS correspondientes al tema inicial al elemento HTML,
  //    indicando que es la carga inicial para evitar transiciones al cargar.
  applyThemeToHtml(selectedThemeId.value, true);

  // 4. Escucha cambios en la preferencia de color del sistema operativo (prefers-color-scheme).
  //    Esto SOLO es relevante si el tema *actualmente seleccionado* es 'system'.
  const handleOsColorSchemeChange = () => {
    if (selectedThemeId.value === 'system') {
      // Si el tema es 'system', lo re-aplicamos para que el navegador actualice
      // las variables CSS de :root según la preferencia del SO.
      applyThemeToHtml('system');
    }
  };

  osPrefersDark.addEventListener('change', handleOsColorSchemeChange);

  // Limpia el event listener cuando el componente se desmonte para evitar fugas de memoria.
  onBeforeUnmount(() => {
    osPrefersDark.removeEventListener('change', handleOsColorSchemeChange);
  });
});
</script>

<style scoped>
.theme-switcher {
  user-select: none;
}

.dropdown-item .fas.fa-circle {
  font-size: 0.7em;
  vertical-align: middle;
}

.dropdown-item.active {
  background-color: var(--color-secondary);
  color: var(--color-text);
}

.dropdown-header {
  color: var(--color-text);
  background-color: var(--color-surface);
}

.dropdown-menu {
  background-color: var(--color-surface);
  border-color: var(--color-border);
}

/* Para deshabilitar transiciones temporalmente */
html.no-transition * {
  transition: none !important;
}
</style>