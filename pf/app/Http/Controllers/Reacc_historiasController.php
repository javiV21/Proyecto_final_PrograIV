<?php

namespace App\Http\Controllers;

use App\Models\Historia;
use App\Models\Reaccion_historia;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Reacc_historiasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validamos que venga historia_id y reaccion
        $data = $request->validate([
            'historia_id' => 'required|exists:historias,id',
            'reaccion'    => 'required|in:1,-1',
        ]);

        $data['usuario_id'] = Auth::id();

        // Primero intentamos encontrar si ya había un voto
        $reaccion = Reaccion_historia::firstOrNew([
            'usuario_id' => $data['usuario_id'],
            'historia_id'=> $data['historia_id'],
        ]);

        // Siempre actualizamos el valor de la reacción
        $reaccion->reaccion = $data['reaccion'];
        $reaccion->save();

        return back(); // redirige a la misma página
    }

    public function update(Request $request, Reaccion_historia $reaccion_historia)
    {
        // Actualizar la reacción de una historia
        $data = $request->validate([
            'reaccion' => 'required|in:1,-1',
        ]);
        $reaccion_historia->update($data);
        return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Mostrar las reacciones de una historia en específico
        $reacciones = Reaccion_historia::where('historia_id', $id)->get();
        return view('showHistoria', compact('reacciones'));
    }
}
