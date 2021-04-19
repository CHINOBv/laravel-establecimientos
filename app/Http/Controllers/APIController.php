<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Establecimiento;
use Illuminate\Http\Request;

class APIController extends Controller
{
    public function categorias()
    {
        $categorias = Categoria::all();
        return response()->json($categorias);
    }

    public function categoria(Categoria $categoria)
    {

        $establecimientos = Establecimiento::where('categoria_id', $categoria->id)->with('categoria')->get();

        return response()->json($establecimientos);
    }

    public function show(Establecimiento $establecimiento)
    {
        $establecimientos = Establecimiento::where('id', $establecimiento->id)
        ->with('categoria')
        ->get();
        return response()->json($establecimientos) ;
    }
}