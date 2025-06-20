<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Tramite extends Model //quiero que esta tabla tenga varios valores foraneos para probar como funciona llamar instancias de otros modelos
{
    //aqui voy a poner primero los datos del tramite que se ingresaran por el formulario
    protected $fillable = [
        'titulo',
        'descripcion',
        'usuario_id',
        't_tipo_id',
        'pagado',
    ];

    protected $casts = [
        'pagado' => 'boolean', // de acuerdo a chatgpt esto le da el valor booleano a pagado
    ];



    public function usuarios()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }



    public function tipo()
    {
        //return $this->belongsTo(TTipo::class, 'tipo_tramite_id');
        return $this->belongsTo(TTipo::class, 't_tipo_id');

    }

    public function citas()
    {
        return $this->hasMany(Cita::class);
    }

}