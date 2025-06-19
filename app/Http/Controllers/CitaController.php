<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\Tramite;
use Illuminate\Http\Request;

class CitaController extends Controller
{
    public function index()
{
    $citas = Cita::with('tramite')
                 ->where('user_id', auth()->id())
                 ->paginate(10);

    return view('citas.index', compact('citas'));
}

    public function create()
{
    // Sólo los trámites creados por el usuario actual
    $tramites = auth()->user()->tramites()->orderBy('titulo')->get();

    return view('citas.create', compact('tramites'));
}


    public function store(Request $request)
    {
        // 1) Validar los datos entrantes
        $data = $request->validate([
            'tramite_id'   => 'required|exists:tramites,id',
            'fecha_hora'   => 'required|date',
            'ubicacion'    => 'required|string|max:255',
            'estado'       => 'required|in:pendiente,confirmada,cancelada',
            'observaciones'=> 'nullable|string',
        ]);

            $data['user_id'] = auth()->id();

    // 3) creamos con Cita::create (asegúrate de tener 'user_id' en $fillable)
            Cita::create($data);

        // 3) Redirigir al listado con mensaje de éxito
        return redirect()
            ->route('citas.index')
            ->with('success', 'Cita agregada correctamente.');
    }

    public function show(Cita $cita)
    {
        return view('citas.show', compact('cita'));
    }

    public function edit(Cita $cita)
    {
        $tramites = auth()->user()->tramites()->orderBy('titulo')->get();
        return view('citas.edit', compact('cita', 'tramites'));
    }

    public function update(Request $request, Cita $cita)
{
    $data = $request->validate([
        'tramite_id'   => 'required|exists:tramites,id',
        'fecha_hora'   => 'required|date',
        'ubicacion'    => 'required|string|max:255',
        'estado'       => 'required|in:pendiente,confirmada,cancelada',
        'observaciones'=> 'nullable|string',
    ]);

    $cita->update($data);

    return redirect()
        ->route('citas.index')
        ->with('success', 'Cita actualizada correctamente.');
}


    public function destroy(Cita $cita)
    {
        $cita->delete();
        return redirect()
            ->route('citas.index')
            ->with('success', 'Cita cancelada/eliminada.');
    }
}
