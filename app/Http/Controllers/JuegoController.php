<?php

namespace App\Http\Controllers;

use App\Models\Juego;
use App\Models\Idioma;
use Illuminate\Http\Request;

class JuegoController extends Controller
{
    // READ (Todos con JOIN de Idioma)
    public function index()
    {
        $juegos = Juego::with('idioma')->get();

        return view('juegos.index', compact('juegos'));
    }

    // READ (Uno)
    public function show(Juego $juego)
    {
        $juego->load(['idioma', 'expansiones']);

        return view('juegos.show', compact('juego'));
    }

    // CREATE
    public function store(Request $request)
    {
        $validated = $request->validate([
            'titulo'    => 'required|string|max:100',
            'anio'      => 'required|integer|min:1900|max:2099',
            'idioma_id' => 'required|exists:idiomas,id',
        ]);

        $juego = Juego::create($validated);

        return response()->json([
            'message' => 'Juego creado correctamente',
            'data'    => $juego
        ], 201);
    }

    // UPDATE
    public function update(Request $request, Juego $juego)
    {
        $validated = $request->validate([
            'titulo'    => 'required|string|max:100',
            'anio'      => 'required|integer|min:1900|max:2099',
            'idioma_id' => 'required|exists:idiomas,id',
        ]);

        $juego->update($validated);

        return response()->json([
            'message' => 'Juego actualizado correctamente',
            'data'    => $juego
        ]);
    }

    // DELETE
    public function destroy(Juego $juego)
    {
        $juego->delete();

        return response()->json(['message' => 'Juego eliminado correctamente']);
    }

    public function create()
    {
        $idiomas = Idioma::all();
        return view('juegos.create', compact('idiomas'));
    }
}