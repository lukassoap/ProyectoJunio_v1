<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable
{
    //
    use Notifiable;
    protected $table = 'usuarios'; // Asegúrate de que el nombre de la tabla sea correcto

    protected $fillable = [
        'nombre', //aca para el login
        'password',
        'conexion',
        'email', //lo de aqui abajo es para el registro
        'telefono',
    ];
    protected $casts = [
    'conexion' => 'boolean'
    ];

    protected $hidden = [
        'password', // necesito probar esto
        'remember_token', //maybe idk
    ];

    public function tramites()
    {
        return $this->hasMany(Tramite::class, 'usuario_id');
    }
}
