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
        try{
            $historias = Historia::with(['user', 'categoria'])
                ->withCount('comentarios')                                      // crea $h->comentarios_count
                ->withSum('reacciones_historia as reacciones_count', 'reaccion') // crea $h->reacciones_count
                ->latest()
                ->get();

            return view('home', compact('historias'));            
        } catch (\Exception $e) {
            \Log::error('Error al obtener las historias: ' . $e->getMessage());
            return redirect()->route('home')->with('error', 'Error al cargar las historias.');
        }
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
        try{
            $data = $request->validate([
                'categoria_id' => 'required|exists:categorias,id',
                'titulo' => 'required|string|max:255',
                'contenido' => 'required|string',
            ]);
            $data['usuario_id'] = Auth::id();

            Historia::create($data);
            return redirect()->route('home')->with('success', 'Historia creada con éxito.');            
        }catch (\Exception $e) {
            \Log::error('Error al crear la historia: ' . $e->getMessage());
            return redirect()->route('home')->with('error', 'Error al crear la historia.');
        }
    }

    // Función para ver una histoira en especifico
    public function show(Historia $historia)
    {
        try{
            // Cargar la relación con el usuario y la categoría
            // de la historia sobre la que se hace click
            // y también los comentarios
            // (si los hay)
            
            $historia->load(['user', 'categoria', 'comentarios.user']);
            $historia->loadCount('comentarios');
            $historia->loadSum('reacciones_historia as reacciones_count', 'reaccion');
            return view('showHistoria', compact('historia'));            
        }catch (\Exception $e) {
            \Log::error('Error al mostrar la historia: ' . $e->getMessage());
            return redirect()->route('home')->with('error', 'Error al cargar la historia.');
        }
    }


    // Editar una historia
    public function edit(Historia $historia)
    {
        try{
            $categorias = Categoria::orderBy('nombre')->get();
            return view('editHistoria', compact('historia', 'categorias'));            
        }catch (\Exception $e) {
            \Log::error('Error al editar la historia: ' . $e->getMessage());
            return redirect()->route('home')->with('error', 'Error al cargar el formulario de edición.');
        }
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Historia $historia)
    {
        try{
            $data = $request->validate([
                'categoria_id' => 'required|exists:categorias,id',
                'titulo' => 'required|string|max:255',
                'contenido' => 'required|string',
            ]);
            $historia->update($data);
            return redirect()->route('home')->with('success', 'Historia actualizada con éxito.');            
        } catch (\Exception $e) {
            \Log::error('Error al actualizar la historia: ' . $e->getMessage());
            return redirect()->route('home')->with('error', 'Error al actualizar la historia.');
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Historia $historia)
    {
        try{
            // Eliminar los comentarios relacionados
            Comentario::where('historia_id', $historia->id)->delete();
            // Eliminar las reacciones relacionadas
            $historia->reacciones_historia()->delete();
            // Eliminar la historia
            $historia->delete();
            // Redirigir a la página de inicio con un mensaje de éxito
            return redirect()->route('home')->with('success', 'Historia eliminada con éxito.');            
        } catch (\Exception $e) {
            \Log::error('Error al eliminar la historia: ' . $e->getMessage());
            return redirect()->route('home')->with('error', 'Error al eliminar la historia.');
        }
    }
}