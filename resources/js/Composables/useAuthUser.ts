// import { ref, onMounted, computed } from 'vue';
// import UserService from '@/Services/AuthUserService';
// import { AuthUser } from '@/Types/AuthUser';

// /**
//  * Composable para gestionar el estado de autenticación simulado.
//  * Proporciona el usuario autenticado actual y la funcionalidad para cargarlo.
//  */
// export function useAuth() {
//   const currentUser = ref<AuthUser | null>(null); // Almacena el usuario autenticado
//   const loadingUser = ref(true); // Indica si el usuario está cargando
//   const errorUser = ref<string | null>(null); // Almacena cualquier error

//   /**
//    * Carga el usuario autenticado simulado desde el UserService.
//    */
//   const fetchCurrentUser = async () => {
//     loadingUser.value = true;
//     errorUser.value = null;
//     try {
//       const user = await UserService.getAuthenticatedUser();
//       currentUser.value = user;
//     } catch (e) {
//       console.error('Error al cargar usuario simulado:', e);
//       errorUser.value = 'No se pudo cargar el usuario.';
//       currentUser.value = null;
//     } finally {
//       loadingUser.value = false;
//     }
//   };

//   // Cargar el usuario al montar el composable (o el componente que lo use)
//   onMounted(() => {
//     fetchCurrentUser();
//   });

//   return {
//     currentUser,
//     loadingUser,
//     errorUser,
//     fetchCurrentUser,
//     isAuthenticated: computed(() => currentUser.value !== null) // Propiedad computada para saber si hay usuario
//   };
// }