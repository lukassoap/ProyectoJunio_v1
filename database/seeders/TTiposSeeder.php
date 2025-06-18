<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TTipo;

class TTiposSeeder extends Seeder
{
    public function run()
    {
        TTipo::insert([
            ['nombre' => 'Licencia de Conducir', 'descripcion' => 'Trámite para obtener la licencia de conducir', 'costo' => 25.00],
            ['nombre' => 'Pasaporte', 'descripcion' => 'Solicitud y emisión de pasaporte', 'costo' => 50.00],
            ['nombre' => 'Cédula de Identidad', 'descripcion' => 'Emisión de documento de identidad', 'costo' => 15.00],
            ['nombre' => 'Matrícula Vehicular', 'descripcion' => 'Registro de vehículo ante el estado', 'costo' => 30.00],
            ['nombre' => 'Certificado de Nacimiento', 'descripcion' => 'Emisión de certificado legal de nacimiento', 'costo' => 10.00],
        ]);
    }
}
