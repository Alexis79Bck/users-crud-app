// Define una interfaz para la estructura de una notificación.
interface Notification {
  id: number;
  icon: string;
  title: string;
  time: string;
}

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
        { id: 1, icon: 'fas fa-envelope', title: '4 nuevos mensajes', time: '3 mins' },
        { id: 2, icon: 'fas fa-users', title: '8 solicitudes', time: '12 horas' },
        { id: 3, icon: 'fas fa-file', title: '3 informes nuevos', time: '2 días' },
        { id: 4, icon: 'fas fa-exclamation-triangle', title: 'Advertencia del sistema', time: '1 hora' },
        { id: 5, icon: 'fas fa-check-circle', title: 'Copia de seguridad completa', time: 'Ayer' },
        { id: 6, icon: 'fas fa-cloud-upload-alt', title: 'Actualización disponible', time: '5 días' }
      ]), 500);
    });
  }
};