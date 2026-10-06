<?php

namespace App\Http\Controllers;

use App\Models\Plato;
use App\Http\Requests\StorePlatoRequest;
use App\Http\Requests\UpdatePlatoRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PlatoController extends Controller
{
    public function index()
    {
        $platos = Plato::paginate(10);
        return view('platos.index', compact('platos'));
    }

    public function create()
    {
        return view('platos.create');
    }

    public function store(StorePlatoRequest $request)
    {
        $validated = $request->validated();

        if ($request->hasFile('imagen')) {
            $file = $request->file('imagen');
            $year = now()->format('Y');
            $month = now()->format('m');
            $folder = "platos/{$year}/{$month}";
            
            $extension = $file->getClientOriginalExtension();
            $filename = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) 
                        . '-' . uniqid() 
                        . '.' . $extension;
                        
            $path = $file->storeAs($folder, $filename, 'public');
            $validated['imagen'] = $path;
        }

        Plato::create($validated);

        return redirect()->route('platos.create')->with('success', 'Plato creado exitosamente.');
    }

    public function edit(Plato $plato)
    {
        return view('platos.edit', compact('plato'));
    }

    public function update(UpdatePlatoRequest $request, Plato $plato)
    {
        $validated = $request->validated();

        if ($request->hasFile('imagen')) {
            if ($plato->imagen && Storage::disk('public')->exists($plato->imagen)) {
                Storage::disk('public')->delete($plato->imagen);
            }

            $file = $request->file('imagen');
            $year = now()->format('Y');
            $month = now()->format('m');
            $folder = "platos/{$year}/{$month}";
            
            $extension = $file->getClientOriginalExtension();
            $filename = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) 
                        . '-' . uniqid() 
                        . '.' . $extension;
                        
            $path = $file->storeAs($folder, $filename, 'public');
            $validated['imagen'] = $path;
        }

        $plato->update($validated);

        return redirect()->route('platos.index')->with('success', 'Plato actualizado exitosamente.');
    }

    public function destroy(Plato $plato)
    {
        $plato->delete();
        return redirect()->route('platos.index')->with('success', 'Plato eliminado correctamente.');
    }
}
