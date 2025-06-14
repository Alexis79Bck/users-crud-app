import { ref, computed } from 'vue';
import MessageService from '@/Services/MessageService';
import { Message } from '@/Types/Message'; // Importa la interfaz Notification


/**
 * Composable para gestionar los mensajes de la aplicación.
 * Proporciona funcionalidad para cargar mensajes y un contador de no leídos.
 */
export function useMessage() {
  const messages = ref<Message[]>([]); // Almacena la lista de mensajes
  const loadingMessages = ref(false);  // Indica si los mensajes están cargando
  const errorMessages = ref<string | null>(null); // Almacena cualquier error

  /**
   * Carga los mensajes desde el servicio.
   */
  const fetchMessages = async () => {
    loadingMessages.value = true;
    errorMessages.value = null;
    try {
      const data = await MessageService.getMessages();
      messages.value = data;
    } catch (e) {
      console.error('Error al cargar mensajes:', e);
      errorMessages.value = 'No se pudieron cargar los mensajes.';
      messages.value = []; // Limpia mensajes en caso de error
    } finally {
      loadingMessages.value = false;
    }
  };

  /**
   * Propiedad computada que devuelve el número de mensajes no leídos.
   */
  const unreadMessagesCount = computed(() => {
    return messages.value.filter(msg => msg.unread).length;
  });

  return {
    messages,
    loadingMessages,
    errorMessages,
    fetchMessages,
    unreadMessagesCount
  };
}