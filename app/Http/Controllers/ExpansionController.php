<?php

namespace App\Http\Controllers;

use App\Models\Juego;
use App\Models\Idioma;
use App\Models\Expansion;
use Illuminate\Http\Request;

class ExpansionController extends Controller
{
    // READ (Todas con JOIN a Juego e Idioma)
    public function index()
    {
        return Expansion::all();
    }

    // READ (Una)
    public function show($id)
    {
        return Expansion::find($id);
    }

    // CREATE
    public function store(Request $request)
    {
        Expansion::create($request->only(['juego_id', 'titulo', 'idioma_id']));

        return response()->json(['message' => 'Expansión creada correctamente']);
    }

    // UPDATE
    public function update(Request $request, $id)
    {
        Expansion::update($id, $request->only(['juego_id', 'titulo', 'idioma_id']));

        return response()->json(['message' => 'Expansión actualizada correctamente']);
    }

    // DELETE
    public function destroy($id)
    {
        Expansion::destroy($id);

        return response()->json(['message' => 'Expansión eliminada correctamente']);
    }

    public function create()
    {
        $juegos = Juego::all();
        $idiomas = Idioma::all();
        return view('expansiones.create', compact('juegos', 'idiomas'));
    }
}
?>