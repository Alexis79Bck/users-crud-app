import { AuthUser } from '@/Types/AuthUser'; // Importa la interfaz AuthUser

// Exporta una función que devuelve un usuario simulado.
// Esto simula que los datos del usuario ya están disponibles, por ejemplo,
// como parte de la respuesta inicial de la página tras un login.
export function getSimulatedAuthenticatedUser(): AuthUser {
  return {
    id: 1,
    name: 'Usuario Simulado',
    email: 'simulado@example.com',
    avatar_url: '/assets/images/avatars/default.png', // Asegúrate de que esta ruta sea válida
    role: 'Administrador'
  };
}