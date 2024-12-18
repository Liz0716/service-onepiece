<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\tomos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class TomoController extends Controller
{
    // Crear el tomo
    public function create(Request $request)
    {
        // Valirdar los datos del request
        $validator = Validator::make($request->all(), [
            'numero_tomo' => 'required',
            'titulo' => 'required',
            'capitulos_incluidos' => 'required',
            'fecha_publicacion' => 'required',
            'portada' => 'required',
            'sinopsis' => 'required',

        ]);

        //Si tiene problemas genere una respuesta
        if ($validator->fails()) {
            return response()->json([
                'estatus' => 0,
                'mensaje' => $validator->errors()

            ]);
        }
        // si no hay problemas, crea el producto
        $tomo = new tomos();
        // Crear
        $tomo->numero_tomo = $request->numero_tomo;
        $tomo->titulo = $request->titulo;
        $tomo->capitulos_incluidos = $request->capitulos_incluidos;
        $tomo->fecha_publicacion = $request->fecha_publicacion;
        $tomo->portada = $request->portada;
        $tomo->sinopsis = $request->sinopsis;

        // guardar
        $tomo->save();
        return response()->json([
            'estatus' => 1,
            'mensaje' => "Tomo Registrado",
            'data' => $tomo

        ]);
    }


    //Obtener todos los tomos
    public function TomosAll()
    {
        $tomo = tomos::all();
        return response()->json([
            'estatus' => 1,
            'data' => $tomo

        ]);
    }

    //Obtener un tomo
    public function TomoId($id)
    {
        $tomo = tomos::find($id);
        return response()->json([
            'estatus' => 1,
            'mensaje' => $tomo
        ]);
    }

    //Editar tomo
    //Editar los productos
    public function update(Request $request, $id)
    {
        // Busqueda del producto
        $tomo = tomos::find($id);
        if (!$tomo) {
            return response()->json([
                'estatus' => 0,
                'mensaje' => 'Tomo no encontrado'
            ]);
        }
        $validator = Validator::make($request->all(), [
            'numero_tomo' => 'required',
            'titulo' => 'required',
            'capitulos_incluidos' => 'required',
            'fecha_publicacion' => 'required',
            'portada' => 'required',
            'sinopsis' => 'required',
        ]);
        if ($validator->fails()) {
            //Si tiene problemas genere una respuesta
            return response()->json([
                'estatus' => 0,
                'mensaje' => $validator->errors()

            ]);
        }
        $tomo->numero_tomo = $request->numero_tomo;
        $tomo->titulo = $request->titulo;
        $tomo->capitulos_incluidos = $request->capitulos_incluidos;
        $tomo->fecha_publicacion = $request->fecha_publicacion;
        $tomo->portada = $request->portada;
        $tomo->sinopsis = $request->sinopsis;

        $tomo->save();

        if ($tomo->save()) {
            return response()->json([
                'estatus' => 1,
                'mensaje' => 'Tomo Actualizado'

            ]);
        } else {
            return response()->json([
                'estatus' => 0,
                'mensaje' => 'Tomo No Actualizado'

            ]);
        }
    }

    //Eliminar tomo
    public function delete($id)
    {
        $tomo = tomos::find($id);
        //Cambiamos el campo de eliminado y guardamos el cambio
        $tomo->eliminado = true;
        $tomo->save();
        return response()->json([
            'estatus' => 1,
            'mensaje' => 'Tomo Eliminado'
        ]);
    }

    //Obtener por filtrado
    public function filter(Request $request)
    {
        //Obtenemos los datos para el filtrado
        $Titulo = $request->query('titulo');
        $Numero = $request->query('numero_tomo');
        $Fecha = $request->query('fecha_publicacion');



        $query = tomos::query();

        // Hacer el filtrado
        if ($Titulo) {
            $query->where('titulo', 'like', '%' . $Titulo . '%');
        }
        if ($Numero) {
            $query->where('numero_tomo', $Numero);
        }
        if ($Fecha) {
            $query->where('fecha_publicacion', $Fecha);
        }

        $resultados = $query->get();

        return response()->json([
            'estatus' => 1,
            'data' => $resultados

        ]);
    }

    //Busqueda con la pregumta
    public function search(Request $request)
    {
        $pregunta = $request->query('pregunta');

        //Verificar que la pregunta no venga vacia
        if (!$pregunta) {
            return response()->json([
                'estatus' => 0,
                'mensaje' => 'Por favor, introduce la pregunta'
            ]);
        }

        //Buscar el tomo de acuerdo a la sinopsis
        $resultados = tomos::where('sinopsis', 'like', '%' . $pregunta . '%')->get();

        //Validar los resultados
        if ($resultados->isEmpty()) {
            return response()->json([
                'estatus' => 0,
                'mensaje' => 'No se encontraron resultados'
            ]);
        }

        // Retornar los resultados
        return response()->json([
            'estatus' => 1,
            'data' => $resultados,
            'mensaje' => 'Resultado encontrado'
        ]);
    }
}
