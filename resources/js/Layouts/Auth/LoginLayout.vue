<template>

    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-cover bg-no-repeat" :style="{ backgroundImage: 'url(' + dynamicBg + ')' }">
        <div v-if="hoverBackground && hoverBackground !== currentBackground"
            class="absolute inset-0 bg-amber-700 bg-opacity-65 flex items-center justify-center text-white text-2xl font-bold transition-opacity duration-300 ease-in-out"
            :class="{ 'opacity-45': hoverBackground, 'opacity-0': !hoverBackground }">
            Previsualizando
        </div>

        <BackgroundSelector @update:background="updateBackground" @hover:background="handleHoverPreview" />
        <ApplicationLogo />
        <div
            class="w-full sm:max-w-md mt-6 px-6 py-4 border border-2 border-indigo-300 bg-indigo-600 shadow-lg overflow-hidden sm:rounded-lg">
            <slot />
        </div>
    </div>
</template>


<script setup>
import { ref, computed } from 'vue';
import BackgroundSelector from '@/Components/BackgroundSelector.vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';

const currentBackground = ref('');
const hoverBackground = ref(null);

// Propiedad computada que determina qué fondo mostrar: previsualización o el actual
const displayBackground = computed(() => {
    return hoverBackground.value || currentBackground.value;
});

// NUEVO: Propiedad computada para generar la clase dinámica de Tailwind
const dynamicBg = computed(() => {
    if (displayBackground.value) {
        // Escapa caracteres especiales en la URL si es necesario, aunque Tailwind suele manejarlo bien
        const escapedUrl = displayBackground.value.replace(/'/g, "\\'");
        return escapedUrl
    }
    return ''; // No aplica ninguna clase si no hay fondo
});


const updateBackground = (newBackgroundUrl) => {
    currentBackground.value = newBackgroundUrl;
    hoverBackground.value = null;
};

const handleHoverPreview = (previewUrl) => {
    hoverBackground.value = previewUrl;
};
</script>



<style scoped>
/* Las mismas transiciones de Tailwind de antes */
.transition-background-image {
  transition-property: background-image;
}
.duration-500 {
  transition-duration: 500ms;
}
.ease-in-out {
  transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
}

</style>


