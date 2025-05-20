<template>
  <div class="fixed bottom-4 right-4 z-50">
    <button
      @click="toggleSelector"
      class="bg-blue-600 hover:bg-blue-700 text-white p-3 rounded-full shadow-lg transition-all duration-300 ease-in-out focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-75"
      aria-label="Abrir selector de fondo"
    >
      <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
      </svg>
    </button>

    <div
      v-if="isOpen"
      class="absolute bottom-full right-0 mb-4 bg-white p-4 rounded-lg shadow-xl w-64 max-h-80 overflow-y-auto transform origin-bottom-right transition-all duration-300 ease-in-out"
      :class="{ 'scale-y-0 opacity-0': !isOpen, 'scale-y-100 opacity-100': isOpen }"
    >
      <h3 class="text-lg font-semibold mb-3 text-gray-800">Seleccionar Fondo</h3>
      <div class="grid grid-cols-2 gap-3">
        <div
          v-for="bg in backgrounds"
          :key="bg.id"
          @click="selectBackground(bg.url)"
          class="relative w-full h-20 bg-cover bg-center rounded-md cursor-pointer border-2 hover:border-blue-500 transition-colors duration-200 ease-in-out"
          :class="{ 'border-blue-600 ring-2 ring-blue-300': selectedBg === bg.url, 'border-gray-300': selectedBg !== bg.url }"
          :style="{ backgroundImage: `url(${bg.url})` }"
        >
          <div v-if="selectedBg === bg.url" class="absolute inset-0 bg-blue-600 bg-opacity-30 flex items-center justify-center rounded-md">
            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
          </div>
        </div>
      </div>
      <button
        @click="resetBackground"
        class="mt-4 w-full bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-4 rounded-md transition-colors duration-200 ease-in-out"
      >
        Restablecer a por defecto
      </button>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, watch } from 'vue';

const emit = defineEmits(['update:background']);

const isOpen = ref(false);
const defaultBackground = '/assets/images/backgrounds/default-bg.jpg';
const selectedBg = ref(defaultBackground); // Estado local de la imagen seleccionada

const backgrounds = ref([
  { id: 1, name: 'Por Defecto', url: defaultBackground },
  { id: 2, name: 'Océano', url: '/assets/images/backgrounds/bg1.jpg' },
  { id: 3, name: 'Montañas', url: '/assets/images/backgrounds/bg2.jpg' },
  { id: 4, name: 'Bosque', url: '/assets/images/backgrounds/bg3.jpg' },
  // Agrega más imágenes aquí
]);

const toggleSelector = () => {
  isOpen.value = !isOpen.value;
};

const selectBackground = (url) => {
  selectedBg.value = url;
  localStorage.setItem('loginBackground', url); // Guardar en localStorage
  emit('update:background', url); // Emitir para que el padre actualice el fondo
  isOpen.value = false; // Cerrar selector
};

const resetBackground = () => {
  selectBackground(defaultBackground); // Establecer por defecto
};

// Cargar el fondo guardado en localStorage al montar el componente
onMounted(() => {
  const storedBackground = localStorage.getItem('loginBackground');
  if (storedBackground) {
    selectedBg.value = storedBackground;
  }
  emit('update:background', selectedBg.value); // Emitir el fondo inicial (guardado o por defecto)
});

// Opcional: Cerrar el selector si se hace clic fuera
const handleClickOutside = (event) => {
  if (isOpen.value && !event.target.closest('.fixed.bottom-4.right-4')) {
    isOpen.value = false;
  }
};

onMounted(() => {
  document.addEventListener('click', handleClickOutside);
});

// Limpiar el evento al desmontar el componente
import { onUnmounted } from 'vue'; // Asegúrate de importar onUnmounted
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