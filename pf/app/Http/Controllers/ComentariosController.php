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
        /*$comentarios = Comentario::with(['historia', 'user'])->get();
        return view('showHistoria', compact('comentarios'));*/
    }

    public function create()
    {
        $historias = Historia::orderBy('id')->get();
        return view('viewcContent.create', compact('historias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Historia $historia)
    {
        $data = $request->validate([
            'contenido' => 'required|string|max:255',
        ]);
        $data['usuario_id'] = Auth::id();
        $data['historia_id'] = $historia->id;

        Comentario::create($data);
        return redirect()
            ->route('historias.show', ['historia' => $historia->id])
            ->with('success', 'Comentario creado con éxito.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        /*$comentario = Comentario::with(['historia', 'user'])->findOrFail($id);
        return view('viewContent.show', compact('comentario'));*/
    }

    
}
