/**
 * Propiedades comunes a todos los tipos de ítems de menú.
 */
interface BaseMenuItem {
  label: string; // Etiqueta visible del ítem
  icon?: string; // Clase de Font Awesome para el icono (opcional)
  badge?: { text: string; class: string; }; // Opcional: para badges como "New", "6", etc.
  isActive: (componentName: string) => boolean; // Función para determinar si el ítem está activo
}

/**
 * Interfaz para un ítem de menú que es un enlace directo.
 */
export interface LinkMenuItem extends BaseMenuItem {
  type: 'link';
  routeName?: string; // Nombre de la ruta de Laravel (para Inertia.js)
  href?: string;      // URL directa para enlaces externos o no-Inertia (ej. #)
  method?: 'get' | 'post' | 'put' | 'delete'; // Método HTTP para enlaces Inertia (ej. para logout)
  as?: 'a' | 'button'; // Cómo renderizar el Link de Inertia (ej. as="button" para logout)
}

/**
 * Interfaz para un ítem de menú que es un encabezado de sección (ej. "EXAMPLES").
 */
export interface HeaderMenuItem {
  type: 'header';
  label: string; // El texto del encabezado
}

/**
 * Interfaz para un ítem de menú que es un submenú desplegable (treeview).
 * Contiene un array de ítems hijos.
 */
export interface TreeviewMenuItem extends BaseMenuItem {
  type: 'treeview';
  children: (LinkMenuItem | TreeviewMenuItem)[]; // Puede contener enlaces o submenús
}

/**
 * Tipo de unión que representa cualquier posible ítem del menú del sidebar.
 */
export type SidebarMenuItem = LinkMenuItem | HeaderMenuItem | TreeviewMenuItem;