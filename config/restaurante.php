<?php

return [
    'platos' => [
        'nombre' => [
            'min' => 3,
            'max' => 100,
        ],
        'precio' => [
            'min' => 1000.00,
            'max' => 999999.99,
        ],
        'descripcion' => [
            'min' => 10,
            'max' => 1000,
        ],
        'imagen' => [
            'mimes' => 'jpg,png,webp',
            'max_kb' => 2048,
        ],
    ],
];
