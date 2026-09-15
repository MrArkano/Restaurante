<?php

namespace App\Http\Controllers;

use App\Models\Idioma;
use Illuminate\Http\Request;

class IdiomaController extends Controller
{
    // READ (Todos)
    public function index()
    {
        return response()->json(Idioma::all());
    }

    // READ (Uno)
    public function show(Idioma $idioma)
    {
        return response()->json($idioma);
    }

    // CREATE
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:50',
            'codigo' => 'required|string|max:5',
        ]);

        $idioma = Idioma::create($validated);

        return response()->json([
            'message' => 'Idioma creado correctamente',
            'data'    => $idioma
        ], 201);
    }

    // UPDATE
    public function update(Request $request, Idioma $idioma)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:50',
            'codigo' => 'required|string|max:5',
        ]);

        $idioma->update($validated);

        return response()->json([
            'message' => 'Idioma actualizado correctamente',
            'data'    => $idioma
        ]);
    }

    // DELETE
    public function destroy(Idioma $idioma)
    {
        $idioma->delete();

        return response()->json(['message' => 'Idioma eliminado correctamente']);
    }

    public function create()
    {
        return view('idiomas.create');
    }
}

