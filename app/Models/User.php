<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use HasUuids;
    use SoftDeletes;

    /** ATRIBUTOS:
     *
     * @var $fillable array<int, string>    Los atributos que son asignables masivamente.
     * @var $hidden array<int, string>      Los atributos que deberían estar ocultos para la serialización.
     * @var $cast array<string, string>    Los atributos que deberían ser convertidos a tipos nativos.
     * @var $incrementing bool                 Indica si los IDs son auto-incrementales.
     * @var $keyType  string               El "tipo" del ID de la clave primaria.
     */

    protected $fillable = [
        'username',
        'email',
        'password',
        'is_admin',
        'status',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'id' => 'string'
    ];

    public $incrementing = false; 

    protected $keyType = 'string'; 


    /**
     * Obtener el perfil del usuario asociado.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function profile(): HasOne
    {
        return $this->hasOne(UserProfile::class, 'user_id', 'id');
    }
}
