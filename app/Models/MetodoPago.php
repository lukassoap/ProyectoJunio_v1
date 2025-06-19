<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MetodoPago extends Model
{
    protected $table = 'metodos_pago';

    protected $fillable = [
        'usuario_id',
        'tipo',
        'numero',
        'titular',
        'fecha_expiracion',
        'cvv',
    ];

    /**
     * Cast attributes to native types.
     *
     * Casting `fecha_expiracion` ensures it is treated as a Carbon instance so
     * date formatting helpers work as expected in the views.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'fecha_expiracion' => 'date',
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }
}