// Importa la interfaz para la estructura de una notificación.
import { Notification } from '@/Types/Notification';

// Exporta un objeto con métodos, tipando las promesas y sus resultados.
export default {
  /**
   * Simula una llamada asíncrona para obtener una lista de notificaciones.
   * @returns {Promise<Notification[]>} Una promesa que resuelve con un array de objetos Notification.
   */
  async getNotifications(): Promise<Notification[]> {
    return new Promise(resolve => {
      // Simula un retardo de red
      setTimeout(() => resolve([
        { id: 1, icon: 'fas fa-envelope', title: '4 Nuevos Comentarios', type: 'Comentario', isRead: false, time: '3 mins' },
        { id: 2, icon: 'fas fa-users', title: '8 Nuevas Solicitudes', type: 'Solicitud', isRead: false, time: '12 horas' },
        { id: 3, icon: 'fas fa-eye', title: '3 Usuarios visistaron tu perfil', type: 'Visita', isRead: false, time: '2 días' },
        { id: 4, icon: 'fas fa-gears', title: 'Sistema', type: 'Sistema', isRead: false, time: '1 hora' },
        { id: 5, icon: 'fas fa-gears', title: 'Sistema', type: 'Sistema', isRead: false, time: '1 hora' },
      ]), 500);
    });
  }
};