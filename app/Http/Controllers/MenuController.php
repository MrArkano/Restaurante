<?php

namespace App\Http\Controllers;

use App\Models\Plato;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        $platos = Plato::orderBy('nombre', 'asc')->get();
        return view('menu.index', compact('platos'));
    }

    public function show(Plato $plato)
    {
        return view('menu.show', compact('plato'));
    }
}
