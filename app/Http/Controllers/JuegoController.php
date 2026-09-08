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
        $juegos = Juego::all();

        return view('juegos.index', compact('juegos'));
    }

    // READ (Uno)
    public function show($id)
    {
        $juego = Juego::find($id);

        // Si no existe el juego, devolvemos un 404
        if (!$juego) {
            abort(404, 'Juego no encontrado');
        }

        return view('juegos.show', compact('juego'));
    }

    // CREATE
    public function store(Request $request)
    {
        Juego::create($request->only(['titulo', 'anio', 'idioma_id']));

        return response()->json(['message' => 'Juego creado correctamente']);
    }

    // UPDATE
    public function update(Request $request, $id)
    {
        Juego::update($id, $request->only(['titulo', 'anio', 'idioma_id']));

        return response()->json(['message' => 'Juego actualizado correctamente']);
    }

    // DELETE
    public function destroy($id)
    {
        Juego::destroy($id);

        return response()->json(['message' => 'Juego eliminado correctamente']);
    }

    public function create()
    {
        $idiomas = Idioma::all();
        return view('juegos.create', compact('idiomas'));
    }
}
?>