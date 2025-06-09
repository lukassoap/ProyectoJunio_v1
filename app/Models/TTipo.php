<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TTipo extends Model
{
    //
    //use HasFactory;
    protected $fillable = [ // puede que ponga estas cosas en tramite en vez de preocuparme por otro objeto
        'nombre',
        'descripcion',
        'costo'
    ];
    public function tramites()
    {
        return $this->hasMany(Tramite::class, 'tipo_tramite_id');
    }
}
