<?php

namespace App\Http\Controllers;

use App\Models\Comentario;
use App\Models\Reaccion_comentario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Reacc_comentariosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $comentarios = Comentario::with(['historia', 'user'])->get();
        return view('viewContent.index', compact('comentarios'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'comentario_id' => 'required|exists:historias,id',
        ]);
        $data['usuario_id'] = Auth::id();

        Comentario::create($data);
        return redirect()->route('comentarios.index')->with('success', 'Like.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
