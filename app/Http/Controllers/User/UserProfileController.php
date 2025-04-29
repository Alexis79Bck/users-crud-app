<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\UserProfileService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserProfileController extends Controller
{
    //private $userProfileService;

    public function __construct(private UserProfileService $userProfileService)
    {}

    /**
     * Muestra el perfil de un usuario específico.
     *
     * @param  int  $userId
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(User $user): JsonResponse
    {
        $profile = $this->userProfileService->getUserProfile($user->id);
        if (!$profile) {
            return response()->json(['error' => 'Perfil no encontrado'], Response::HTTP_NOT_FOUND);
        }
        return response()->json($profile, Response::HTTP_OK);
    }

    /**
     * Actualiza el perfil de un usuario específico en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $userId
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, User $user): JsonResponse
    {
        try {
            $profile = $this->userProfileService->updateUserProfile($user->id, $request->all());
            return response()->json($profile, Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Elimina el perfil de un usuario específico de la base de datos.
     *
     * @param  int  $userId
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(User $user): JsonResponse
    {
        $this->userProfileService->deleteUserProfile($user->id);
        return response()->json(['message' => 'Perfil eliminado exitosamente'], Response::HTTP_OK);
    }

    /**
     * Devuelve el formulario para la edición de un perfil de usuario
     * No se usa en una API, pero se deja como ejemplo
     *
     * @param int $userId
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit(User $user): JsonResponse
    {
        return response()->json(['message' => 'Método no permitido en una API'], Response::HTTP_METHOD_NOT_ALLOWED);
    }
}
