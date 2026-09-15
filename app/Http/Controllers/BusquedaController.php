<?php

namespace App\Http\Controllers;

use App\Models\Juego;
use App\Models\Idioma;
use App\Models\Expansion;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class BusquedaController extends Controller
{
    public function index(Request $request)
    {
        // Validar parámetros de búsqueda
        $request->validate([
            'q'          => 'nullable|string|max:100',
            'anio_desde' => 'nullable|integer|min:1900|max:2099',
            'anio_hasta' => 'nullable|integer|min:1900|max:2099',
            'idioma_id'  => 'nullable|exists:idiomas,id',
        ]);

        // Validar que año desde no sea mayor que año hasta
        if ($request->filled('anio_desde') && $request->filled('anio_hasta')) {
            if ((int)$request->anio_desde > (int)$request->anio_hasta) {
                return back()->withInput()->withErrors([
                    'anio_desde' => 'El año inicial no puede ser mayor que el año final.'
                ]);
            }
        }

        $q          = $request->input('q');
        $anioDesde  = $request->input('anio_desde');
        $anioHasta  = $request->input('anio_hasta');
        $idiomaId   = $request->input('idioma_id');
        $perPage    = 12;

        // ── Consulta de Juegos ──
        $juegosQuery = Juego::with('idioma')
            ->when($q, function ($query, $q) {
                $query->where('titulo', 'LIKE', "%{$q}%");
            })
            ->when($anioDesde && $anioHasta, function ($query) use ($anioDesde, $anioHasta) {
                $query->whereBetween('anio', [(int)$anioDesde, (int)$anioHasta]);
            }, function ($query) use ($anioDesde, $anioHasta) {
                if ($anioDesde) {
                    $query->where('anio', '>=', (int)$anioDesde);
                }
                if ($anioHasta) {
                    $query->where('anio', '<=', (int)$anioHasta);
                }
            })
            ->when($idiomaId, function ($query, $idiomaId) {
                $query->where('idioma_id', $idiomaId);
            });

        $juegos = $juegosQuery->orderBy('titulo')->get()->map(function ($juego) {
            return (object)[
                'id'         => $juego->id,
                'titulo'     => $juego->titulo,
                'tipo'       => 'Juego',
                'anio'       => $juego->anio,
                'idioma'     => $juego->idioma->nombre ?? 'N/A',
                'juego_base' => null,
                'juego_id'   => $juego->id,
                'es_juego'   => true,
            ];
        });

        // ── Consulta de Expansiones ──
        $expansionesQuery = Expansion::with(['juego', 'idioma'])
            ->when($q, function ($query, $q) {
                $query->where('titulo', 'LIKE', "%{$q}%");
            })
            ->when($anioDesde && $anioHasta, function ($query) use ($anioDesde, $anioHasta) {
                $query->whereBetween('anio', [(int)$anioDesde, (int)$anioHasta]);
            }, function ($query) use ($anioDesde, $anioHasta) {
                if ($anioDesde) {
                    $query->where('anio', '>=', (int)$anioDesde);
                }
                if ($anioHasta) {
                    $query->where('anio', '<=', (int)$anioHasta);
                }
            })
            ->when($idiomaId, function ($query, $idiomaId) {
                $query->where('idioma_id', $idiomaId);
            });

        $expansiones = $expansionesQuery->orderBy('titulo')->get()->map(function ($exp) {
            return (object)[
                'id'         => $exp->id,
                'titulo'     => $exp->titulo,
                'tipo'       => 'Expansión',
                'anio'       => $exp->anio,
                'idioma'     => $exp->idioma->nombre ?? 'N/A',
                'juego_base' => $exp->juego->titulo ?? 'N/A',
                'juego_id'   => $exp->juego_id,
                'es_juego'   => false,
            ];
        });

        // ── Combinar y paginar ──
        $combined = $juegos->concat($expansiones)->sortBy('titulo')->values();

        $page = LengthAwarePaginator::resolveCurrentPage();
        $currentItems = $combined->slice(($page - 1) * $perPage, $perPage)->values();

        $resultados = new LengthAwarePaginator(
            $currentItems,
            $combined->count(),
            $perPage,
            $page,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        // ── Idiomas para el filtro ──
        $idiomas = Idioma::orderBy('nombre')->get();

        // ── Verificar si hay filtros activos ──
        $hayFiltros = $request->filled('q') || $request->filled('anio_desde')
                   || $request->filled('anio_hasta') || $request->filled('idioma_id');

        return view('busqueda.index', compact(
            'resultados', 'idiomas', 'q', 'anioDesde', 'anioHasta', 'idiomaId', 'hayFiltros'
        ));
    }
}