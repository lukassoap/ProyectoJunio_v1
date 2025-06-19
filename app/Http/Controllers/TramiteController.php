<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Tramite;
use App\Models\Usuario; // Asegúrate de importar el modelo Usuario si lo necesitas
use App\Models\TTipo; // Importa el modelo TTipo si es necesario
use App\Models\MetodoPago;

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
     * Show available payment methods.
     */
    /**
     * Show the payment method form.
     */
    public function metodoPagoForm(Request $request)
    {
        $tramiteIds = $request->input('tramites', []);
        $tramites = Tramite::where('usuario_id', Auth::id())
            ->whereIn('id', $tramiteIds)
            ->where('pagado', false)
            ->with('tipo')
            ->get();

        $total = $tramites->sum(fn ($t) => $t->tipo->costo);

        $metodos = MetodoPago::where('usuario_id', Auth::id())->get();

        return view('tramites.metodo_pago', compact('tramites', 'total', 'metodos'));
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
     * Show the payment selection page for the user's trámites.
     */
    public function pagar()
    {
        $tramites = Tramite::where('usuario_id', Auth::id())
            ->where('pagado', false)
            ->with('tipo')
            ->get();

        return view('tramites.pagar', compact('tramites'));
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


    /**
     * Process the payment method and mark trámites as paid.
     */
    public function procesarMetodoPago(Request $request)
    {
        $validated = $request->validate([
            'numero' => ['required'],
            'titular' => ['required'],
            'fecha_expiracion' => ['required', 'date'],
            'cvv' => ['required'],
            'tipo' => ['required', 'in:debito,credito'],
            'tramites' => ['required', 'array'],
            'metodo_pago_id' => ['nullable', 'exists:metodos_pago,id'],
        ]);

        if (!$validated['metodo_pago_id'] && $request->has('guardar')) {
            MetodoPago::create([
                'usuario_id' => Auth::id(),
                'tipo' => $validated['tipo'],
                'numero' => $validated['numero'],
                'titular' => $validated['titular'],
                'fecha_expiracion' => $validated['fecha_expiracion'],
                'cvv' => $validated['cvv'],
            ]);
        }

        $tramites = Tramite::where('usuario_id', Auth::id())
            ->whereIn('id', $validated['tramites'])
            ->get();

        foreach ($tramites as $tramite) {
            $tramite->pagado = true;
            $tramite->save();
        }

        return redirect()->route('tramite.index')->with('success', 'Pago procesado correctamente.');
    }


}