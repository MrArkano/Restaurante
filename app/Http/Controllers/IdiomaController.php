<?php

namespace App\Http\Controllers;

use App\Models\Idioma;
use Illuminate\Http\Request;

class IdiomaController extends Controller
{
    // READ (Todos)
    public function index()
    {
        return Idioma::all();
    }

    // READ (Uno)
    public function show($id)
    {
        return Idioma::find($id);
    }

    // CREATE
    public function store(Request $request)
    {
        Idioma::create($request->only(['nombre', 'codigo']));

        return response()->json(['message' => 'Idioma creado correctamente']);
    }

    // UPDATE
    public function update(Request $request, $id)
    {
        Idioma::update($id, $request->only(['nombre', 'codigo']));

        return response()->json(['message' => 'Idioma actualizado correctamente']);
    }

    // DELETE
    public function destroy($id)
    {
        Idioma::destroy($id);

        return response()->json(['message' => 'Idioma eliminado correctamente']);
    }

    public function create()
    {
        return view('idiomas.create');
    }
}
?>
