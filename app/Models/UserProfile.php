<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Nnjeim\World\Models\Country;

class UserProfile extends Model
{
    use HasFactory;
    use SoftDeletes;

    /** ATRIBUTOS:
     *
     * @var $fillable array<int, string>    Los atributos que son asignables masivamente.
     */

    protected $fillable = [
        'user_id',
        'fullname',
        'about',
        'birthdate',
        'gender',
        'country_id',
        'avatar',
    ];

    /**
     * Obtener el usuario al que pertenece el perfil
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Obtener el país de la tabla paises
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'country_id');
    }


}
