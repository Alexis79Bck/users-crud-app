<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\UserProfileController;
use App\Http\Controllers\User\UserController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;



Route::get('/', function () {
    return Inertia::render('Auth/Login');
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');
//->middleware(['auth', 'verified'])
/**
 * * Rutas de Perfil de Usuario Logueado
 */
Route::middleware('auth')->group(function () {
    Route::get('/profile', [UserProfileController::class, 'show'])->name('profile.show');       // Mostrar el perfil del usuario logueado
    Route::get('/profile/edit', [UserProfileController::class, 'edit'])->name('profile.edit');  // Mostrar el formulario para editar el perfil del usuario logueado
    Route::patch('/profile', [UserProfileController::class, 'update'])->name('profile.update');  // Actualizar el perfil del usuario logueado
});

/**
 * * Rutas de CRUD de Perfiles de Usuarios (Administración)
 */
Route::middleware(['auth', 'can:manage-users'])->group(function () {
    // Rutas para la gestión de usuarios
    Route::get('/users', [UserController::class, 'index'])->name('users.index');       // Listar todos los usuarios
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');     // Mostrar el formulario para crear un nuevo usuario
    Route::post('/users', [UserController::class, 'store'])->name('users.store');        // Crear un nuevo usuario
    Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');          // Mostrar un usuario específico
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');    // Mostrar el formulario para editar un usuario existente
    Route::patch('/users/{user}', [UserController::class, 'update'])->name('users.update');    // Actualizar un usuario existente
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy'); // Eliminar un usuario existente

    // Rutas para la gestión de perfiles de usuario (anidadas dentro de /users)
    Route::get('/users/{user}/profile', [UserProfileController::class, 'show'])->name('users.profiles.show'); // Mostrar el perfil de un usuario específico
    Route::get('/users/{user}/profile/edit', [UserProfileController::class, 'edit'])->name('users.profiles.edit'); // Mostrar el formulario para editar el perfil de un usuario específico
    Route::patch('/users/{user}/profile', [UserProfileController::class, 'update'])->name('users.profiles.update');  // Actualizar el perfil de un usuario específico
    Route::delete('/users/{user}/profile', [UserProfileController::class, 'destroy'])->name('users.profiles.destroy'); // Eliminar el perfil de un usuario específico
});



require __DIR__.'/auth.php';
