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

    public function create()
    {
        try{
            $historias = Historia::orderBy('id')->get();
            return view('viewcContent.create', compact('historias'));            
        } catch (\Exception $e) {
            \Log::error('Error al obtener las historias: ' . $e->getMessage());
            return redirect()->route('home')->with('error', 'Error al cargar las historias.');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Historia $historia)
    {
        try{
            $data = $request->validate([
                'contenido' => 'required|string',
            ]);
            $data['usuario_id'] = Auth::id();
            $data['historia_id'] = $historia->id;

            Comentario::create($data);
            return redirect()
                ->route('historias.show', ['historia' => $historia->id])
                ->with('success', 'Comentario creado con éxito.');            
        } catch (\Exception $e) {
            \Log::error('Error al crear el comentario: ' . $e->getMessage());
            return redirect()
                ->route('historias.show', ['historia' => $historia->id])
                ->with('error', 'Error al crear el comentario.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $comentario = Comentario::with(['historia', 'user'])->findOrFail($id);
        return view('showHistoria', compact('comentario'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comentario $comentario)
    {
        try{
            return view('editComentarios', compact('comentario'));
        } catch (\Exception $e) {
            \Log::error('Error al cargar el formulario de edición: ' . $e->getMessage());
            return redirect()->route('user.profile')->with('error', 'Error al cargar el comentario para editar.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comentario $comentario)
    {
        try{
            $data = $request->validate(['contenido' => 'required|string']);
            $comentario->update($data);

            return redirect()->route('user.profile')->with('success', 'Comentario actualizado con éxito.');  
        } catch (\Exception $e) {
            \Log::error('Error al actualizar el comentario: ' . $e->getMessage());
            return redirect()->route('user.profile')->with('error', 'Error al actualizar el comentario.');
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comentario $comentario)
    {
        try{
            $comentario->delete();

            return redirect()->route('user.profile')
                            ->with('success', 'Comentario eliminado con éxito.');
        } catch (\Exception $e) {
            \Log::error('Error al eliminar el comentario: ' . $e->getMessage());
            return redirect()->route('user.profile')
                            ->with('error', 'Error al eliminar el comentario.');
        }
    }    
}
