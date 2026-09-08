<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Expansion // extends Model
{
    protected $table = 'expansiones';
    public $timestamps = true;
    protected $fillable = ['juego_id', 'titulo', 'idioma_id'];

    public static function all()
    {
        return DB::select('
            SELECT e.id, e.titulo, j.titulo AS juego_base, i.nombre AS idioma 
            FROM expansiones e
            INNER JOIN juegos j ON e.juego_id = j.id
            INNER JOIN idiomas i ON e.idioma_id = i.id
        ');
    }

    public static function find($id)
    {
        $expansiones = DB::select('
            SELECT e.id, e.titulo, j.titulo AS juego_base, i.nombre AS idioma 
            FROM expansiones e
            INNER JOIN juegos j ON e.juego_id = j.id
            INNER JOIN idiomas i ON e.idioma_id = i.id
            WHERE e.id = ?
        ', [$id]);

        return $expansiones[0] ?? null;
    }

    public static function create(array $datos)
    {
        return DB::insert('INSERT INTO expansiones (juego_id, titulo, idioma_id) VALUES (?, ?, ?)', [
            $datos['juego_id'] ?? null,
            $datos['titulo'] ?? null,
            $datos['idioma_id'] ?? null
        ]);
    }

    public static function update($id, array $datos)
    {
        return DB::update('UPDATE expansiones SET juego_id = ?, titulo = ?, idioma_id = ? WHERE id = ?', [
            $datos['juego_id'] ?? null,
            $datos['titulo'] ?? null,
            $datos['idioma_id'] ?? null,
            $id
        ]);
    }

    public static function destroy($id)
    {
        return DB::delete('DELETE FROM expansiones WHERE id = ?', [$id]);
    }
}
?>