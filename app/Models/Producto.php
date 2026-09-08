<?php

namespace App\Models;

class Producto
{
    private static array $productos = [
        [
            'id' => 1,
            'titulo' => 'Cien años de soledad',
            'autor' => 'Gabriel García Márquez',
            'precio' => 65000,
            'categoria' => 'Realismo Mágico',
            'descripcion' => 'La emblemática historia de la familia Buendía en el mítico pueblo de Macondo.',
            'imagen' => 'https://images.unsplash.com/photo-1544947950-fa07a98d237f?auto=format&fit=crop&w=600&q=80',
            'stock' => 15,
            'destacado' => true
        ],
        [
            'id' => 2,
            'titulo' => '1984',
            'autor' => 'George Orwell',
            'precio' => 48000,
            'categoria' => 'Ciencia Ficción',
            'descripcion' => 'Una visión distópica sobre la vigilancia total y la pérdida de libertades individuales.',
            'imagen' => 'https://images.unsplash.com/photo-1543002588-bfa74002ed7e?auto=format&fit=crop&w=600&q=80',
            'stock' => 8,
            'destacado' => false
        ],
        [
            'id' => 3,
            'titulo' => 'El principito',
            'autor' => 'Antoine de Saint-Exupéry',
            'precio' => 35000,
            'categoria' => 'Fábula Filosófica',
            'descripcion' => 'Un clásico poético que reflexiona sobre la amistad, el amor y la naturaleza humana.',
            'imagen' => 'https://images.unsplash.com/photo-1512820790803-83ca734da794?auto=format&fit=crop&w=600&q=80',
            'stock' => 20,
            'destacado' => true
        ],
        [
            'id' => 4,
            'titulo' => 'Hábitos Atómicos',
            'autor' => 'James Clear',
            'precio' => 59000,
            'categoria' => 'Desarrollo Personal',
            'descripcion' => 'Estrategias prácticas para construir buenos hábitos y deshacerse de los malos poco a poco.',
            'imagen' => 'https://images.unsplash.com/photo-1589829085413-56de8ae18c73?auto=format&fit=crop&w=600&q=80',
            'stock' => 12,
            'destacado' => true
        ],
        [
            'id' => 5,
            'titulo' => 'Fahrenheit 451',
            'autor' => 'Ray Bradbury',
            'precio' => 45000,
            'categoria' => 'Ciencia Ficción',
            'descripcion' => 'Un futuro donde los libros están prohibidos y los bomberos tienen la misión de quemarlos.',
            'imagen' => 'https://images.unsplash.com/photo-1532012164546-f432f2e3777a?auto=format&fit=crop&w=600&q=80',
            'stock' => 5,
            'destacado' => false
        ],
        [
            'id' => 6,
            'titulo' => 'El Alquimista',
            'autor' => 'Paulo Coelho',
            'precio' => 42000,
            'categoria' => 'Ficción',
            'descripcion' => 'El viaje de Santiago en busca de un tesoro que lo lleva a descubrir su leyenda personal.',
            'imagen' => 'https://images.unsplash.com/photo-1495640388908-05fa85288e61?auto=format&fit=crop&w=600&q=80',
            'stock' => 10,
            'destacado' => false
        ]
    ];

    public static function all(): array
    {
        return self::$productos;
    }
}