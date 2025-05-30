<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
use App\Models\Historia;

class CategoriasController extends Controller
{
    public function index(Request $request, Categoria $categoria = null)
    {
        $categorias = Categoria::all();

        $historias = collect(); // Inicializa como una colección vacía
        if ($categoria) {
            $historias = Historia::with(['user', 'categoria'])
                ->withCount('comentarios')
                ->withSum('reacciones_historia as reacciones_count', 'reaccion')
                ->where('categoria_id', $categoria->id)
                ->latest()
                ->get();
        } else {
             // Si no hay categoría seleccionada, puedes cargar algunas historias por defecto,
             // por ejemplo, las más recientes o populares.
             $historias = Historia::with(['user', 'categoria'])
                ->withCount('comentarios')
                ->withSum('reacciones_historia as reacciones_count', 'reaccion')
                ->latest()
                ->limit(10) // Limita a 10 las publicaciones recientes por defecto
                ->get();
        }


        // Aquí el 'categoria' de la vista será null si no se seleccionó ninguna.
        return view('viewPost_categoria', compact('categorias', 'categoria', 'historias'));
    }

    public function historiasAjax(Categoria $categoria)
    {
        $historias = Historia::with(['user', 'categoria'])
            ->withCount('comentarios')
            ->withSum('reacciones_historia as reacciones_count', 'reaccion')
            ->where('categoria_id', $categoria->id)
            ->latest()
            ->get();

        // DEVUELVE SÓLO EL PARTIAL DE HISTORIAS
        return view('partials._historias_list', compact('historias'))->render();
    }
}