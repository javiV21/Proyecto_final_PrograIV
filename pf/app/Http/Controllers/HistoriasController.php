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
        // Obtener las historias mas recientes
        // y cargar la relación con el usuario y la categoría
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

    // Función para ver una histoira en especifico
    // al dar click en el título
    // y que muestre el contenido completo
    // (con comentarios)
    public function show(Historia $historia)
    {
        // Cargar la relación con el usuario y la categoría
        // de la historia sobre la que se hace click
        // y también los comentarios
        // (si los hay)
        
        $historia->load(['user', 'categoria']);
        return view('showHistoria', compact('historia'));
    }

}