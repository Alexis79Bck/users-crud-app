// resources/js/Services/SidebarService.ts

import { SidebarMenuItem } from '@/Types/Sidebar'; // Importa el tipo SidebarMenuItem

/**
 * Simula la obtención de la estructura del menú del sidebar.
 * @returns {SidebarMenuItem[]} Un array con la definición de los ítems del menú.
 */
export function getSidebarMenu(): SidebarMenuItem[] {
  return [
    {
      type: 'link',
      label: 'Dashboard',
      icon: 'fas fa-tachometer-alt',
      routeName: 'dashboard',
      isActive: (componentName: string) => componentName === 'Dashboard',
    },
    {
      type: 'header',
      label: 'PROCESOS',
    },
    {
      type: 'link',
      label: 'Usuarios',
      icon: 'fas fa-users',
      routeName: 'users.index',
      isActive: (componentName: string) => componentName.startsWith('Users/'),
    },
    {
      type: 'link',
      label: 'Posts',
      icon: 'fas fa-newspaper',
      routeName: 'posts.index',
      isActive: (componentName: string) => componentName.startsWith('Post/'),
    },
    {
      type: 'header',
      label: 'CONFIGURACION DE SISTEMA',
    },
    {
      type: 'treeview',
      label: 'Sistema',
      icon: 'fas fa-cogs',
      children: [
        {
          type: 'link',
          label: 'Configuración General',
          icon: 'far fa-circle',
          routeName: 'settings.general',
          isActive: (componentName: string) => componentName === 'Settings/General',
        },
        {
          type: 'link',
          label: 'Roles',
          icon: 'far fa-circle',
          routeName: 'roles.index',
          isActive: (componentName: string) => componentName === 'Roles/Index',
        },
        {
          type: 'link',
          label: 'Permisos',
          icon: 'far fa-circle',
          routeName: 'permissions.index',
          isActive: (componentName: string) => componentName === 'Permissions/Index',
        },
      ],
      isActive: (componentName: string) =>
        componentName.startsWith('Settings/') ||
        componentName.startsWith('Roles/') ||
        componentName.startsWith('Permissions/'),
    },
    // {
    //   type: 'link',
    //   label: 'Reportes',
    //   icon: 'fas fa-chart-line',
    //   routeName: 'reports.index',
    //   isActive: (componentName: string) => componentName === 'Reports/Index',
    // },
    // {
    //   type: 'header',
    //   label: 'EJEMPLOS',
    // },
    // {
    //   type: 'link',
    //   label: 'Calendario',
    //   icon: 'far fa-calendar-alt',
    //   routeName: 'calendar.index',
    //   badge: { text: '2', class: 'badge-info' },
    //   isActive: (componentName: string) => componentName === 'Calendar/Index',
    // },
    // {
    //   type: 'link',
    //   label: 'Galería',
    //   icon: 'far fa-image',
    //   routeName: 'gallery.index',
    //   isActive: (componentName: string) => componentName === 'Gallery/Index',
    // },
    // {
    //   type: 'link',
    //   label: 'Kanban Board',
    //   icon: 'fas fa-columns',
    //   routeName: 'kanban.index',
    //   isActive: (componentName: string) => componentName === 'Kanban/Index',
    // },
    // {
    //   type: 'treeview',
    //   label: 'Mailbox',
    //   icon: 'far fa-envelope',
    //   children: [
    //     {
    //       type: 'link',
    //       label: 'Inbox',
    //       icon: 'far fa-circle',
    //       routeName: 'mailbox.inbox',
    //       isActive: (componentName: string) => componentName === 'Mailbox/Inbox',
    //     },
    //     {
    //       type: 'link',
    //       label: 'Compose',
    //       icon: 'far fa-circle',
    //       routeName: 'mailbox.compose',
    //       isActive: (componentName: string) => componentName === 'Mailbox/Compose',
    //     },
    //     {
    //       type: 'link',
    //       label: 'Read',
    //       icon: 'far fa-circle',
    //       routeName: 'mailbox.read',
    //       isActive: (componentName: string) => componentName === 'Mailbox/Read',
    //     },
    //   ],
    //   isActive: (componentName: string) => componentName.startsWith('Mailbox/'),
    // },
    // {
    //   type: 'header',
    //   label: 'ETIQUETAS',
    // },
    // {
    //   type: 'link',
    //   label: 'Importante',
    //   icon: 'far fa-circle text-danger',
    //   routeName: '#', // Ejemplo de enlace que no lleva a una ruta real de Inertia
    //   isActive: (componentName: string) => false,
    // },
    {
      type: 'link',
      label: 'Cerrar Sesión',
      icon: 'fas fa-sign-out-alt',
      routeName: 'logout',
      method: 'post',
      as: 'button',
      isActive: (componentName: string) => false,
    },
  ];
}