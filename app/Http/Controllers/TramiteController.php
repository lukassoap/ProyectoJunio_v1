<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Tramite;
use App\Models\Usuario; // Asegúrate de importar el modelo Usuario si lo necesitas
use App\Models\TTipo; // Importa el modelo TTipo si es necesario

class TramiteController extends Controller
{
    /**
     * Display a listing of the user's trámites.
     */
    public function index()
    {
        $tramites = Tramite::where('usuario_id', Auth::id())->get();
        return view('tramites.index', compact('tramites'));
    }

    /**
     * Show the form for creating a new trámite.
     */
    public function create()
    {
        $tipos = \App\Models\TTipo::all();
        return view('tramites.create', compact('tipos'));
    }

    /**
     * Store a newly created trámite in storage.
     */
    public function store(Request $request)
{
    $validated = $request->validate([
        'titulo' => ['required', 'string', 'max:255'],
        'descripcion' => ['required', 'string'],
        't_tipo_id' => ['required', 'exists:t_tipos,id'],
        'pagado' => ['nullable', 'boolean'],
    ]);

    Tramite::create([
        'titulo' => $validated['titulo'],
        'descripcion' => $validated['descripcion'],
        'usuario_id' => Auth::id(),
        't_tipo_id' => $validated['t_tipo_id'],
        'pagado' => $request->has('pagado'), // true if checkbox is checked
    ]);

    return redirect()->route('tramite.index')->with('success', 'Trámite creado correctamente.');
}


    /**
     * Display the specified trámite.
     */
    public function show($id)
    {
        $tramite = Tramite::findOrFail($id);
        // Puedes verificar autorización:
        // $this->authorize('view', $tramite);
        return view('tramites.show', compact('tramite'));
    }

    /**
     * Remove the specified trámite from storage.
     */
    public function destroy($id)
    {
        $tramite = Tramite::findOrFail($id);
        // $this->authorize('delete', $tramite);
        $tramite->delete();
        return redirect()->route('tramite.index')->with('success', 'Trámite eliminado correctamente.');
    }
}