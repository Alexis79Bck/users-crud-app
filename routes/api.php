<?php

use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\UserProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'api'], function () {
    // Rutas para la gestión de usuarios
    Route::get('/users', [UserController::class, 'index'])->name('api.users.index');       // Listar todos los usuarios
    Route::post('/users', [UserController::class, 'store'])->name('api.users.store');        // Crear un nuevo usuario
    Route::get('/users/{user}', [UserController::class, 'show'])->name('api.users.show');          // Mostrar un usuario específico
    Route::patch('/users/{user}', [UserController::class, 'update'])->name('api.users.update');    // Actualizar un usuario existente
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('api.users.destroy'); // Eliminar un usuario existente

    // Rutas para la gestión del perfil del usuario logueado
    Route::get('/profile', [UserProfileController::class, 'show'])->name('api.profile.show');       // Mostrar el perfil del usuario logueado
    Route::patch('/profile', [UserProfileController::class, 'update'])->name('api.profile.update');    // Actualizar el perfil del usuario logueado

    // Rutas para la gestión de perfiles de usuario (anidadas dentro de /users)
    Route::get('/users/{user}/profile', [UserProfileController::class, 'show'])->name('api.users.profiles.show'); // Mostrar el perfil de un usuario específico
    Route::patch('/users/{user}/profile', [UserProfileController::class, 'update'])->name('api.users.profiles.update');  // Actualizar el perfil de un usuario específico
    Route::delete('/users/{user}/profile', [UserProfileController::class, 'destroy'])->name('api.users.profiles.destroy'); // Eliminar el perfil de un usuario específico
});
