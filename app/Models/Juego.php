<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Juego // extends Model
{
    protected $table = 'juegos';
    public $timestamps = true;
    protected $fillable = ['titulo', 'anio', 'idioma_id'];

    public static function all()
    {
        return DB::select('
            SELECT j.id, j.titulo, j.anio, i.nombre AS idioma 
            FROM juegos j 
            INNER JOIN idiomas i ON j.idioma_id = i.id
        ');
    }

    public static function find($id)
    {
        $juegos = DB::select('
            SELECT j.id, j.titulo, j.anio, i.nombre AS idioma 
            FROM juegos j 
            INNER JOIN idiomas i ON j.idioma_id = i.id
            WHERE j.id = ?
        ', [$id]);

        return $juegos[0] ?? null;
    }

    public static function create(array $datos)
    {
        return DB::insert('INSERT INTO juegos (titulo, anio, idioma_id) VALUES (?, ?, ?)', [
            $datos['titulo'] ?? null,
            $datos['anio'] ?? null,
            $datos['idioma_id'] ?? null
        ]);
    }

    public static function update($id, array $datos)
    {
        return DB::update('UPDATE juegos SET titulo = ?, anio = ?, idioma_id = ? WHERE id = ?', [
            $datos['titulo'] ?? null,
            $datos['anio'] ?? null,
            $datos['idioma_id'] ?? null,
            $id
        ]);
    }

    public static function destroy($id)
    {
        return DB::delete('DELETE FROM juegos WHERE id = ?', [$id]);
    }
}
?>