// Define una interfaz para la estructura de un mensaje.
interface Message {
  id: number;
  name: string;
  avatar: string;
  text: string;
  time: string;
  unread: boolean;
}

// Exporta un objeto con métodos, tipando las promesas y sus resultados.
export default {
  /**
   * Simula una llamada asíncrona para obtener una lista de mensajes.
   * @returns {Promise<Message[]>} Una promesa que resuelve con un array de objetos Message.
   */
  async getMessages(): Promise<Message[]> {
    return new Promise(resolve => {
      // Simula un retardo de red
      setTimeout(() => resolve([
        {
          id: 1,
          name: 'Brad Diesel',
          avatar: 'dist/img/user1-128x128.jpg', // Asegúrate de que esta ruta sea correcta o dinámica
          text: 'Llámame cuando puedas...',
          time: '4 Horas',
          unread: true
        },
        {
          id: 2,
          name: 'John Pierce',
          avatar: 'dist/img/user8-128x128.jpg', // Asegúrate de que esta ruta sea correcta o dinámica
          text: 'Recibí tu mensaje',
          time: '4 Horas',
          unread: false
        },
        {
          id: 3,
          name: 'Alice Johnson',
          avatar: 'dist/img/user3-128x128.jpg', // Asegúrate de que esta ruta sea correcta o dinámica
          text: '¿Nos reunimos mañana?',
          time: '1 día',
          unread: true
        },
        {
          id: 4,
          name: 'Charlie Brown',
          avatar: 'dist/img/user4-128x128.jpg', // Asegúrate de que esta ruta sea correcta o dinámica
          text: 'Gracias por tu ayuda.',
          time: '2 días',
          unread: false
        },
        {
          id: 5,
          name: 'Eve Williams',
          avatar: 'dist/img/user5-128x128.jpg', // Asegúrate de que esta ruta sea correcta o dinámica
          text: 'Te envié el documento.',
          time: '3 días',
          unread: false
        },
        {
          id: 6,
          name: 'David Miller',
          avatar: 'dist/img/user6-128x128.jpg', // Asegúrate de que esta ruta sea correcta o dinámica
          text: '¿Puedes revisar esto?',
          time: '1 semana',
          unread: true
        },
        {
          id: 7,
          name: 'Sophia Garcia',
          avatar: 'dist/img/user7-128x128.jpg', // Asegúrate de que esta ruta sea correcta o dinámica
          text: '¡Felicitaciones por el ascenso!',
          time: '2 semanas',
          unread: false
        }
      ]), 500);
    });
  }
};