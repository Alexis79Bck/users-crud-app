/**
 * Interfaz que define la estructura de un usuario autenticado.
 * Aqui se encontrara las propiedades necesarias del usuario autenticado
 * expone típicamente en `page.props.auth.user`.
 */
export interface AuthUser {
  id: number;
  name: string;
  email: string;
  avatar_url?: string; // URL opcional del avatar del usuario
  role?: string;       // Rol opcional del usuario (ej. 'Administrador', 'Editor')
}