<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePlatoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $config = config('restaurante.platos');
        
        return [
            'nombre' => [
                'required', 
                'string', 
                'min:' . $config['nombre']['min'], 
                'max:' . $config['nombre']['max'], 
                'unique:platos,nombre'
            ],
            'precio' => [
                'required', 
                'numeric', 
                'min:' . $config['precio']['min'],
                'max:' . $config['precio']['max'],
            ],
            'descripcion' => [
                'required', 
                'string', 
                'min:' . $config['descripcion']['min'],
                'max:' . $config['descripcion']['max'],
            ],
            'imagen' => [
                'required', 
                'image', 
                'mimes:' . $config['imagen']['mimes'], 
                'max:' . $config['imagen']['max_kb']
            ],
        ];
    }

    public function messages(): array
    {
        $config = config('restaurante.platos');
        
        return [
            'nombre.required' => 'El nombre del plato es obligatorio.',
            'nombre.min' => 'El nombre debe tener al menos ' . $config['nombre']['min'] . ' caracteres.',
            'nombre.max' => 'El nombre no puede exceder los ' . $config['nombre']['max'] . ' caracteres.',
            'nombre.unique' => 'Ya existe un plato con este nombre en el menú.',
            
            'precio.required' => 'El precio del plato es obligatorio.',
            'precio.numeric' => 'El precio debe ser un valor numérico.',
            'precio.min' => 'El precio mínimo permitido es de $' . number_format($config['precio']['min'], 0, ',', '.') . ' COP.',
            'precio.max' => 'El precio máximo permitido es de $' . number_format($config['precio']['max'], 0, ',', '.') . ' COP.',
            
            'descripcion.required' => 'La descripción es obligatoria.',
            'descripcion.min' => 'La descripción debe tener al menos ' . $config['descripcion']['min'] . ' caracteres.',
            'descripcion.max' => 'La descripción no puede exceder los ' . $config['descripcion']['max'] . ' caracteres.',
            
            'imagen.required' => 'La imagen del plato es obligatoria.',
            'imagen.image' => 'El archivo debe ser una imagen válida.',
            'imagen.mimes' => 'La imagen debe estar en uno de estos formatos: ' . $config['imagen']['mimes'] . '.',
            'imagen.max' => 'El peso de la imagen no puede superar los ' . ($config['imagen']['max_kb'] / 1024) . ' MB.',
        ];
    }
}
