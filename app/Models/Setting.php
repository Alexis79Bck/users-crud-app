<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'value',
        'type', // Para ayudar a interpretar el valor (string, boolean, integer, json)
        'group', // Para agrupar configuraciones (general, appearance, users, content)
        'description', // Para el UI del administrador
    ];

    protected $casts = [
        'value' => 'string', // Por defecto como string, el servicio lo manejará según 'type'
    ];
}
