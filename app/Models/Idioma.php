<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Idioma // extends Model
{
    protected $table = 'idiomas';
    public $timestamps = true;
    protected $fillable = ['nombre', 'codigo'];

    public static function all()
    {
        return DB::select('SELECT * FROM idiomas');
    }

    public static function find($id)
    {
        $idiomas = DB::select('SELECT * FROM idiomas WHERE id = ?', [$id]);

        return $idiomas[0] ?? null;
    }

    public static function create(array $datos)
    {
        return DB::insert('INSERT INTO idiomas (nombre, codigo) VALUES (?, ?)', [
            $datos['nombre'] ?? null,
            $datos['codigo'] ?? null
        ]);
    }

    public static function update($id, array $datos)
    {
        return DB::update('UPDATE idiomas SET nombre = ?, codigo = ? WHERE id = ?', [
            $datos['nombre'] ?? null,
            $datos['codigo'] ?? null,
            $id
        ]);
    }

    public static function destroy($id)
    {
        return DB::delete('DELETE FROM idiomas WHERE id = ?', [$id]);
    }
}
?>