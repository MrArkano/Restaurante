<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    public function index()
    {
        return view('home', [
            'app_name' => config('app.name', 'ULibro')
        ]);
    }

    public function productos()
    {
        return view('productos', [
            'productos' => Producto::all(),
            'app_name' => config('app.name', 'ULibro')
        ]);
    }
}