<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    protected $fillable = [
        'tramite_id',
        'user_id',
        'fecha_hora',
        'ubicacion',
        'estado',
        'observaciones',
    ];

    public function tramite()
    {
        return $this->belongsTo(Tramite::class);
    }

    public function user()
{
    return $this->belongsTo(User::class);
}
}
