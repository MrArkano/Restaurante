<?php

namespace App\Http\Controllers;

use App\Models\Juego;
use App\Models\Idioma;
use App\Models\Expansion;
use Illuminate\Http\Request;

class ExpansionController extends Controller
{
    // READ (Todas con eager loading)
    public function index()
    {
        $expansiones = Expansion::with(['juego', 'idioma'])->get();

        return response()->json($expansiones);
    }

    // READ (Una)
    public function show(Expansion $expansione)
    {
        $expansione->load(['juego', 'idioma']);

        return response()->json($expansione);
    }

    // CREATE
    public function store(Request $request)
    {
        $validated = $request->validate([
            'juego_id'  => 'required|exists:juegos,id',
            'titulo'    => 'required|string|max:100',
            'anio'      => 'nullable|integer|min:1900|max:2099',
            'idioma_id' => 'required|exists:idiomas,id',
        ]);

        $expansion = Expansion::create($validated);

        return response()->json([
            'message' => 'Expansión creada correctamente',
            'data'    => $expansion
        ], 201);
    }

    // UPDATE
    public function update(Request $request, Expansion $expansione)
    {
        $validated = $request->validate([
            'juego_id'  => 'required|exists:juegos,id',
            'titulo'    => 'required|string|max:100',
            'anio'      => 'nullable|integer|min:1900|max:2099',
            'idioma_id' => 'required|exists:idiomas,id',
        ]);

        $expansione->update($validated);

        return response()->json([
            'message' => 'Expansión actualizada correctamente',
            'data'    => $expansione
        ]);
    }

    // DELETE
    public function destroy(Expansion $expansione)
    {
        $expansione->delete();

        return response()->json(['message' => 'Expansión eliminada correctamente']);
    }

    // Formulario de creación
    public function create()
    {
        $juegos = Juego::orderBy('titulo')->get();
        $idiomas = Idioma::orderBy('nombre')->get();

        return view('expansiones.create', compact('juegos', 'idiomas'));
    }
}