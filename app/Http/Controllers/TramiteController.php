<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TramiteController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * TENGO QUE COMPARAR CON UN PROYECTO VIEJO Y VER QUE PASA CON LOS MODELOS
     */
    public function index()
    {
        //
        // Aquí puedes implementar la lógica para listar los trámites
        // Por ejemplo, podrías usar Eloquent para obtener todos los trámites
        $tramites = Tramite::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        // Aquí puedes implementar la lógica para mostrar el formulario de creación de un nuevo trámite
        // Por ejemplo, podrías retornar una vista con un formulario para crear un nuevo trámite
        return view('tramites.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        // Aquí puedes implementar la lógica para almacenar un nuevo trámite
        // Por ejemplo, podrías validar los datos del formulario y crear un nuevo trámite usando Eloquent
        $validatedData = $request->validate([
            'usuario_id' => 'required|exists:usuarios,id',
            'tipo_tramite_id' => 'required|exists:t_tipos,id',
            'estado' => 'required|string|max:255',
        ]);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        // Aquí puedes implementar la lógica para mostrar un trámite específico
        // Por ejemplo, podrías usar Eloquent para encontrar el trámite por su ID y retornar una vista con los detalles del trámite
        $tramite = Tramite::findOrFail($id);
        return view('tramites.show', compact('tramite'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        // Aquí puedes implementar la lógica para mostrar el formulario de edición de un trámite específico
        // Por ejemplo, podrías usar Eloquent para encontrar el trámite por su ID y retornar una vista con un formulario de edición
        $tramite = Tramite::findOrFail($id);
        return view('tramites.edit', compact('tramite'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        // Aquí puedes implementar la lógica para actualizar un trámite específico
        // Por ejemplo, podrías validar los datos del formulario y actualizar el trámite usando Eloquent
        $validatedData = $request->validate([
            'usuario_id' => 'required|exists:usuarios,id',
            'tipo_tramite_id' => 'required|exists:t_tipos,id',
            'estado' => 'required|string|max:255',
        ]);
        $tramite = Tramite::findOrFail($id);
        $tramite->update($validatedData);
        return redirect()->route('tramites.show', $tramite->id)->with('success', 'Trámite actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    
    public function TramitesPorUsuario($usuarioId)
    {
        // Aquí puedes implementar la lógica para obtener los trámites por usuario
        // Por ejemplo, podrías usar Eloquent para buscar los trámites asociados al usuario
        /*$tramites = Tramite::where('usuario_id', $usuarioId)->get();
        
        return response()->json($tramites);*/
        $usuario = Usuario::with('tramites')->find($id);

    }
}
