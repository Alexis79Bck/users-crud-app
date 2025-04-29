<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    //private $userService;

    public function __construct(private UserService $userService)
    {}

    /**
     * Muestra una lista de todos los usuarios.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(?Request $request): JsonResponse
    {
        $users = $this->userService->getAllWithProfile($request->perPage);
        return response()->json($users, Response::HTTP_OK);
    }

    /**
     * Almacena un nuevo usuario en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        try {
            $user = $this->userService->createUser($request->all());
            return response()->json($user, Response::HTTP_CREATED);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Muestra los detalles de un usuario específico.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(User $user): JsonResponse
    {
        $user = $this->userService->getUserWithProfile($user->id);
        return response()->json($user, Response::HTTP_OK);
    }

    /**
     * Actualiza un usuario existente en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, User $user): JsonResponse
    {
        try {
            $this->userService->updateUser($user->id, $request->all());
            return response()->json(['message' => 'Usuario actualizado exitosamente'], Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Elimina un usuario de la base de datos.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(User $user): JsonResponse
    {
        $this->userService->deleteUser($user->id);
        return response()->json(['message' => 'Usuario eliminado exitosamente'], Response::HTTP_OK);
    }
     /**
     * Devuelve el formulario para la creación de un nuevo usuario
     * No se usa en una API, pero se deja como ejemplo
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(): JsonResponse
    {
        return response()->json(['message' => 'Método no permitido en una API'], Response::HTTP_METHOD_NOT_ALLOWED);
    }
     /**
     * Devuelve el formulario para la edición de un usuario
     * No se usa en una API, pero se deja como ejemplo
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function edit(User $user): JsonResponse
    {
       return response()->json(['message' => 'Método no permitido en una API'], Response::HTTP_METHOD_NOT_ALLOWED);
    }
}
