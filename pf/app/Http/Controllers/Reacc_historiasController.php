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
        $historias = Historia::with(['user'])->get();
        return view('viewContent.index', compact('historias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'historia_id' => 'required|exists:historias,id',
        ]);
        $data['usuario_id'] = Auth::id();

        Reaccion_historia::create($data);
        return redirect()->route('historias.index')->with('success', 'Like.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $historia = Historia::with(['user'])->findOrFail($id);
        return view('viewContent.show', compact('historia'));
    }
}
