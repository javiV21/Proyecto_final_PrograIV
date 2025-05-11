<?php

namespace App\Http\Controllers;

use App\Models\Historia;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HistoriasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $historias = Historia::with(['user','categoria'])->latest()->get();
        return view('home', compact('historias'));
    }

    public function create()
    {
        $categorias = Categoria::orderBy('nombre')->get();
        return view('createPost', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'categoria_id' => 'required|exists:categorias,id',
            'titulo' => 'required|string|max:255',
            'contenido' => 'required|string',
        ]);
        $data['usuario_id'] = Auth::id();

        Historia::create($data);
        return redirect()->route('home')->with('success', 'Historia creada con éxito.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Historia $historia)
    {
        $historia->load(['users', 'categoria']);
        return view('home', compact('historia'));
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
