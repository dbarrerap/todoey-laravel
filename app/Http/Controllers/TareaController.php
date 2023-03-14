<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tarea;
use Illuminate\Pagination\LengthAwarePaginator;

class TareaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tareas = Tarea::all();

        $response = ($request->paginate) ? new LengthAwarePaginator(
            $tareas->forPage($request->page, $request->size),
            $tareas->count(),
            $request->size,
            $request->page
        ) : $tareas;

        return response()->json($response->toArray());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tarea = new Tarea();
        $tarea->nombre = $request['nombre'];
        $tarea->fecha = $request['fecha'];
        $tarea->realizado = $request['realizado'];
        $tarea->descripcion = $request['descripcion'];
        $tarea->save();

        return response()->json($tarea->toArray(), 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Tarea $tarea)
    {
        return response()->json($tarea->toArray());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tarea $tarea)
    {
        $tarea->nombre = $request['nombre'];
        $tarea->fecha = $request['fecha'];
        $tarea->realizado = $request['realizado'];
        $tarea->descripcion = $request['descripcion'];
        $tarea->save();

        return response()->json($tarea->toArray());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tarea $tarea)
    {
        $tarea->delete();
        return response()->json(['message' => 'Tarea eliminada'], 204);
    }
}
