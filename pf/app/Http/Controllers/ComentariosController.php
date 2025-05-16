<?php

namespace App\Http\Controllers;

use App\Models\Comentario;
use App\Models\Historia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ComentariosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $comentarios = Comentario::with(['historia', 'user'])->get();
        return view('viewContent.index', compact('comentarios'));
    }

    public function create()
    {
        $historias = Historia::orderBy('id')->get();
        return view('viewcContent.create', compact('historias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'historia_id' => 'required|exists:historias,id',
            'contenido' => 'required|string|max:255',
        ]);
        $data['usuario_id'] = Auth::id();

        Comentario::create($data);
        return redirect()->route('comentarios.index')->with('success', 'Comentario creado con éxito.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $comentario = Comentario::with(['historia', 'user'])->findOrFail($id);
        return view('viewContent.show', compact('comentario'));
    }

    
}
