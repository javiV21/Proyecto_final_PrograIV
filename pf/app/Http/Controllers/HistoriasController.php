<?php

namespace App\Http\Controllers;

use App\Models\Historia;
use App\Models\Categoria;
use App\Models\Comentario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HistoriasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $historias = Historia::with(['user', 'categoria'])
            ->withCount('comentarios')                                      // crea $h->comentarios_count
            ->withSum('reacciones_historia as reacciones_count', 'reaccion') // crea $h->reacciones_count
            ->latest()
            ->get();

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
    public function show(Historia $historia)
    {
        // Cargar la relación con el usuario y la categoría
        // de la historia sobre la que se hace click
        // y también los comentarios
        // (si los hay)
        
        $historia->load(['user', 'categoria', 'comentarios.user']);
        $historia->loadCount('comentarios');
        $historia->loadSum('reacciones_historia as reacciones_count', 'reaccion');
        return view('showHistoria', compact('historia'));
    }


    // Editar una historia
    public function edit(Historia $historia)
    {
        $categorias = Categoria::orderBy('nombre')->get();
        return view('editHistoria', compact('historia', 'categorias'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Historia $historia)
    {
        $data = $request->validate([
            'categoria_id' => 'required|exists:categorias,id',
            'titulo' => 'required|string|max:255',
            'contenido' => 'required|string',
        ]);
        $historia->update($data);
        return redirect()->route('home')->with('success', 'Historia actualizada con éxito.');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Historia $historia)
    {
        // Eliminar los comentarios relacionados
        Comentario::where('historia_id', $historia->id)->delete();
        // Eliminar las reacciones relacionadas
        $historia->reacciones_historia()->delete();
        // Eliminar la historia
        $historia->delete();
        // Redirigir a la página de inicio con un mensaje de éxito
        return redirect()->route('home')->with('success', 'Historia eliminada con éxito.');
    }

}