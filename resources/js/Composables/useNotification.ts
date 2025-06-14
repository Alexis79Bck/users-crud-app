import { ref, computed } from 'vue';
import NotificationService from '@/Services/NotificationService';
import { Notification } from '@/Types/Notification'; // Importa la interfaz Notification

/**
 * Composable para gestionar las notificaciones de la aplicación.
 * Proporciona funcionalidad para cargar notificaciones y un contador.
 */
export function useNotification() {
  const notifications = ref<Notification[]>([]); // Almacena la lista de notificaciones
  const loadingNotifications = ref(false); // Indica si las notificaciones están cargando
  const errorNotifications = ref<string | null>(null); // Almacena cualquier error

  /**
   * Carga las notificaciones desde el servicio.
   */
  const fetchNotifications = async () => {
    loadingNotifications.value = true;
    errorNotifications.value = null;
    try {
      const data = await NotificationService.getNotifications();
      notifications.value = data;
    } catch (e) {
      console.error('Error al cargar notificaciones:', e);
      errorNotifications.value = 'No se pudieron cargar las notificaciones.';
      notifications.value = []; // Limpia notificaciones en caso de error
    } finally {
      loadingNotifications.value = false;
    }
  };

  /**
   * Propiedad computada que devuelve el número total de notificaciones NO LEÍDAS.
   */
  const unreadNotificationsCount = computed(() => { // CAMBIADO DE totalNotificationsCount
    return notifications.value.filter(notif => !notif.isRead).length; // Filtra por isRead: false
  });

  // Opcional: Propiedad computada para agrupar notificaciones por tipo (útil para el dropdown)
  const groupedNotifications = computed(() => {
    const groups: { [key: string]: Notification[] } = {};
    notifications.value.forEach(notif => {
      if (!groups[notif.type]) {
        groups[notif.type] = [];
      }
      groups[notif.type].push(notif);
    });
    return groups;
  });

  return {
    notifications,
    loadingNotifications,
    errorNotifications,
    fetchNotifications,
    totalNotificationsCount: unreadNotificationsCount,
  };
}