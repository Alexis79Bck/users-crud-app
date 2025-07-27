<template>
  <div class="container mx-auto py-8">
    <div class="flex items-center justify-between mb-6">
      <h1 class="text-2xl font-bold text-gray-800">Listado de Posts</h1>
      <button
        class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-4 py-2 rounded shadow"
        @click="goToCreate"
      >
        Nuevo Post
      </button>
    </div>

    <div v-if="loading" class="text-center py-8 text-gray-500">Cargando posts...</div>
    <div v-else-if="error" class="text-center py-8 text-red-500">{{ error }}</div>
    <div v-else>
      <table class="min-w-full bg-white rounded shadow overflow-hidden">
        <thead>
          <tr class="bg-gray-100 text-gray-700">
            <th class="px-4 py-2 text-left">#</th>
            <th class="px-4 py-2 text-left">Título</th>
            <th class="px-4 py-2 text-left">Autor</th>
            <th class="px-4 py-2 text-left">Estado</th>
            <th class="px-4 py-2 text-left">Acciones</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="post in posts" :key="post.id" class="border-b hover:bg-gray-50">
            <td class="px-4 py-2">{{ post.id }}</td>
            <td class="px-4 py-2">{{ post.title }}</td>
            <td class="px-4 py-2">{{ post.author }}</td>
            <td class="px-4 py-2">
              <span :class="statusClass(post.status)">{{ post.status }}</span>
            </td>
            <td class="px-4 py-2 space-x-2">
              <button class="text-blue-600 hover:underline" @click="goToShow(post.id)">Ver</button>
              <button class="text-yellow-600 hover:underline" @click="goToEdit(post.id)">Editar</button>
              <button class="text-red-600 hover:underline" @click="deletePost(post.id)">Eliminar</button>
            </td>
          </tr>
        </tbody>
      </table>
      <div v-if="posts.length === 0" class="text-center py-8 text-gray-500">No hay posts registrados.</div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref, onMounted } from 'vue';
import { router } from '@inertiajs/vue3';

interface Post {
  id: number;
  title: string;
  author: string;
  status: string;
}

const posts = ref<Post[]>([]);
const loading = ref(true);
const error = ref<string | null>(null);

const fetchPosts = async () => {
  loading.value = true;
  error.value = null;
  try {
    // Simulación de fetch, reemplazar por llamada real a API o Inertia
    posts.value = [
      { id: 1, title: 'Primer Post', author: 'Juan Pérez', status: 'Publicado' },
      { id: 2, title: 'Segundo Post', author: 'Ana Gómez', status: 'Borrador' },
      { id: 3, title: 'Tercer Post', author: 'Carlos Ruiz', status: 'Archivado' },
    ];
  } catch (e) {
    error.value = 'No se pudieron cargar los posts.';
  } finally {
    loading.value = false;
  }
};

onMounted(fetchPosts);

const goToCreate = () => router.visit('/posts/create');
const goToShow = (id: number) => router.visit(`/posts/${id}`);
const goToEdit = (id: number) => router.visit(`/posts/${id}/edit`);
const deletePost = (id: number) => {
  if (confirm('¿Seguro que deseas eliminar este post?')) {
    // Aquí iría la lógica real de eliminación (API o Inertia)
    posts.value = posts.value.filter(post => post.id !== id);
  }
};

const statusClass = (status: string) => {
  switch (status) {
    case 'Publicado':
      return 'text-green-600 font-semibold';
    case 'Borrador':
      return 'text-yellow-600 font-semibold';
    case 'Archivado':
      return 'text-gray-400 font-semibold';
    default:
      return '';
  }
};
</script>
