<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tramite extends Model //quiero que esta tabla tenga varios valores foraneos para probar como funciona llamar instancias de otros modelos
{
    //aqui voy a poner primero los datos del tramite que se ingresaran por el formulario
    protected $fillable = [
        'usuario_id', // ID del usuario que realiza el trámite
        'tipo_tramite_id', // ID del tipo de trámite
        'estado', // Estado del trámite (pendiente, en proceso, completado, etc.)
    ];

    protected $casts = [
        'pagado' => 'boolean', // de acuerdo a chatgpt esto le da el valor booleano a pagado
    ];



    public function usuarios()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }



    public function ttipos()
    {
        return $this->belongsTo(TTipo::class, 'tipo_tramite_id');
    }

}
