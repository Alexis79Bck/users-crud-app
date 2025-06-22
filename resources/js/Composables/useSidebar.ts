// resources/js/Composables/useSidebar.ts

import { ref, onMounted } from 'vue';
import { usePage } from '@inertiajs/vue3';
import { getSidebarMenu } from '@/Services/SidebarService'; // Importa el servicio
import { SidebarMenuItem, LinkMenuItem, TreeviewMenuItem } from '@/Types/Sidebar'; // Importa los tipos

/**
 * Composable para gestionar el estado y los datos del menú del sidebar.
 * Proporciona el array de ítems del menú y la lógica para su activación.
 */
export function useSidebar() {
  const sidebarMenuItems = ref<SidebarMenuItem[]>([]); // Almacena los ítems del menú
  const loadingSidebar = ref(false); // Indica si el menú está cargando
  const errorSidebar = ref<string | null>(null); // Almacena errores

  const page = usePage(); // Para acceder a $page.component (nombre del componente actual de Inertia)

  /**
   * Carga los ítems del menú del sidebar desde el servicio.
   */
  const fetchSidebarMenu = async () => {
    loadingSidebar.value = true;
    errorSidebar.value = null;
    try {
      const data = getSidebarMenu(); // Por ahora, es una función síncrona
      sidebarMenuItems.value = data;
    } catch (e) {
      console.error('Error al cargar el menú del sidebar:', e);
      errorSidebar.value = 'No se pudo cargar el menú del sidebar.';
      sidebarMenuItems.value = [];
    } finally {
      loadingSidebar.value = false;
    }
  };

  // Carga el menú al montar el composable
  onMounted(() => {
    fetchSidebarMenu();
  });

  // Funciones para la lógica de activa/desplegado para AppSidebarMenu.vue
  // Estas son las funciones que se pasarán a isActive en cada ítem del menú
  const isItemActive = (item: SidebarMenuItem): boolean => {
    // Si el ítem es un enlace o un treeview, usa su función isActive
    if (item.type === 'link' || item.type === 'treeview') {
      return item.isActive(page.component);
    }
    return false;
  };

  const isTreeviewOpen = (item: TreeviewMenuItem): boolean => {
    // Un treeview está abierto si el componente actual está activo para él
    // o si alguno de sus hijos está activo.
    if (item.isActive(page.component)) {
      return true;
    }
    // Opcional: Recursivamente comprobar si algún hijo está activo
    return item.children.some(child => isItemActive(child));
  };


  return {
    sidebarMenuItems,
    loadingSidebar,
    errorSidebar,
    fetchSidebarMenu,
    isItemActive,
    isTreeviewOpen,
    // Puedes exponer otras propiedades o funciones si es necesario
  };
}