<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    //
    protected $fillable = [
        'nombre', //aca para el login
        'password',
        'conexion',
        'email', //lo de aqui abajo es para el registro
        'telefono'
    ];
    protected $casts = [
    'conexion' => 'boolean'
    ];

    protected $hidden = [
        'password', // necesito probar esto
    ];

    public function tramites()
    {
        return $this->hasMany(Tramite::class, 'usuario_id');
    }
}
