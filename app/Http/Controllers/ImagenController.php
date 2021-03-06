<?php

namespace App\Http\Controllers;

use App\Models\Imagen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class ImagenController extends Controller
{
    //
    public function store( Request $request)
    {
        $ruta_imagen = $request->file('file')->store('establecimientos', 'public');

        //Resize
        $imagen = Image::make(public_path("storage/{$ruta_imagen}"))->fit(800, 450 );
        $imagen->save();

        //Save on DB
        $imagenDB = new Imagen;
        $imagenDB->id_establecimiento = $request['uuid'];
        $imagenDB->ruta_imagen = $ruta_imagen;
        $imagenDB->save();

        $respuesta = [
            'archivo' => $ruta_imagen,
        ];

        //return $request->file('file');
        return response()->json($respuesta);
    }
    public function destroy(Request $request)
    {
        $imagen = $request->get('imagen');

        if(File::exists('/storage' . $imagen)){
            File::delete('/storage'.$imagen);
        }

        $respuesta = [
            'mensaje' => 'Imagen Eliminada',
            'imagen_eliminar' => $imagen,
        ];

        Imagen::where('ruta_imagen', '=', $imagen)->delete();

        return response()->json($respuesta);
    }
}