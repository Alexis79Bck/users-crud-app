<template>
  <div class="fixed bottom-4 right-4 z-50">
    <button @click="toggleSelector"
      class="bg-indigo-600 hover:bg-indigo-600/50 text-white p-3 rounded-full shadow-lg transition-all duration-300 ease-in-out focus:outline-none focus:ring-2 focus:ring-cyan-300 focus:ring-opacity-75"
      aria-label="Abrir selector de fondo">
      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z">
        </path>
      </svg>
    </button>

    <div v-if="isOpen"
      class="absolute bottom-full right-0 mb-4 bg-white p-4 rounded-lg shadow-xl w-80 max-h-64 overflow-y-auto transform origin-bottom-right transition-all duration-300 ease-in-out"
      :class="{ 'scale-y-0 opacity-0': !isOpen, 'scale-y-100 opacity-100': isOpen }">
      <h3 class="text-lg font-semibold mb-3 text-gray-800">Seleccionar Fondo</h3>
      <div class="grid grid-cols-2 gap-3">
        <div v-for="bg in backgrounds" :key="bg.id" @click="selectBackground(bg.url)" @mouseenter="emit('hover:background', bg.url)" @mouseleave="emit('hover:background', null)"
          class="relative w-full h-20 bg-cover bg-center rounded-md cursor-pointer border-2 hover:border-indigo-600 transition-colors duration-200 ease-in-out"
          :class="{ 'border-indigo-600 ring-2 ring-purple-300': selectedBg === bg.url, 'border-neutral-300': selectedBg !== bg.url }"
          :style="{ backgroundImage: `url(${bg.url})` }">
          <div v-if="selectedBg === bg.url"
            class="absolute inset-0 bg-blue-600 bg-opacity-30 flex items-center justify-center rounded-md">
            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"
              xmlns="http://www.w3.org/2000/svg">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
          </div>
        </div>
      </div>
      <button @click="resetBackground"
        class="mt-4 w-full bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-4 rounded-md transition-colors duration-200 ease-in-out">
        Restablecer a por defecto
      </button>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, onUnmounted, watch } from 'vue';

const emit = defineEmits(['update:background','hover:background']);

const isOpen = ref(false);
let defaultBackground = ''; // Define la imagen por defecto
const selectedBg = ref(''); // Estado local de la imagen seleccionada

const backgrounds = ref([]); // Ref para almacenar los datos del JSON

const toggleSelector = () => {
  isOpen.value = !isOpen.value;
};

// Función para seleccionar un fondo
const selectBackground = (url) => {
  selectedBg.value = url;
  localStorage.setItem('loginBackground', url); // Guardar en localStorage
  emit('update:background', url); // Emitir para que el padre actualice el fondo
  emit('hover:background', null); // Limpiar previsualización al seleccionar
  isOpen.value = false; // Cerrar selector
};

// Función para restablecer el fondo al por defecto
const resetBackground = () => {
  selectBackground(defaultBackground); // Establecer por defecto
};

// Función para establecer la previsualización del fondo al pasar el mouse
const setHoverPreview = (url) => {
  emit('hover:background', url); // Emite la URL del fondo que se está previsualizando
};

// Función para limpiar la previsualización del fondo al quitar el mouse
const clearHoverPreview = () => {
  emit('hover:background', null); // Emite null para indicar que se debe limpiar la previsualización
};

// Cargar el JSON y luego el fondo guardado en localStorage
onMounted(async () => {
  try {
    const response = await fetch('/assets/images/backgrounds/backgrounds.json');
    if (!response.ok) {
      throw new Error(`HTTP error! status: ${response.status}`);
    }
    const data = await response.json();
    backgrounds.value = data; // Asigna los datos del JSON a la ref

    // Una vez cargados los fondos, establece el fondo por defecto (el primer elemento del JSON)
    // Asegúrate de que tu JSON tenga al menos un elemento o maneja el caso vacío
    if (backgrounds.value.length > 0) {
      defaultBackground = backgrounds.value[0].url;
      selectedBg.value = defaultBackground; // Inicializa con el por defecto
    }

    // Luego intenta cargar el fondo guardado
    const storedBackground = localStorage.getItem('loginBackground');
    if (storedBackground) {
      // Verifica si el fondo guardado todavía existe en la lista de fondos
      if (backgrounds.value.some(bg => bg.url === storedBackground)) {
        selectedBg.value = storedBackground;
      } else {
        // Si el fondo guardado no existe en la lista actual, restablecer a por defecto
        localStorage.removeItem('loginBackground');
        selectedBg.value = defaultBackground;
      }
    }

    // Emite el fondo inicial (guardado o por defecto) para que el padre lo aplique
    emit('update:background', selectedBg.value);
  } catch (error) {
    console.error('Error al cargar backgrounds.json:', error);
    // Fallback si el JSON no se puede cargar o es inválido
    // Puedes definir un fondo de fallback fijo aquí o manejar el error visualmente
    selectedBg.value = '/assets/images/backgrounds/default.jpg'; // Usar tu imagen default.jpg hardcodeada como fallback
    emit('update:background', selectedBg.value);
  }
});

//  Cerrar el selector si se hace clic fuera
const handleClickOutside = (event) => {
  if (isOpen.value && !event.target.closest('.fixed.bottom-4.right-4')) {
    isOpen.value = false;
    emit('hover:background', null);
  }
};

// Agregar el evento al montar el componente
onMounted(() => {
  document.addEventListener('click', handleClickOutside);
});

// Limpiar el evento al desmontar el componente
onUnmounted(() => {
  document.removeEventListener('click', handleClickOutside);
});

// Observar cambios en selectedBg y emitir si cambian (asegura que el padre siempre esté actualizado)
watch(selectedBg, (newValue) => {
  emit('update:background', newValue);
});
</script>

<style scoped>
/* Transición para el selector al abrir/cerrar */
.transition-all {
  transition-property: all;
}

.duration-300 {
  transition-duration: 300ms;
}

.ease-in-out {
  transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
}

.origin-bottom-right {
  transform-origin: bottom right;
}

.scale-y-0 {
  transform: scaleY(0);
}

.scale-y-100 {
  transform: scaleY(1);
}

.opacity-0 {
  opacity: 0;
}

.opacity-100 {
  opacity: 1;
}
</style>