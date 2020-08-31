<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Personal;
use App\Anexo04;
use App\Detalle;
use App\MetasIndividuales;
use DB;
use Carbon\Carbon;

class ActividadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $anex4 = new MetasIndividuales;
        $anex4->detalle_id = $request->detalle_id;
        $anex4->actividad = $request->actividad;
        $anex4->dia = $request->dia;
        $anex4->horas = $request->horas;
        $anex4->objetivo = $request->objetivo;
        $anex4->indicador = $request->indicador;
        $anex4->meta = $request->meta;
        $anex4->evidencia = $request->evidencia;
        $anex4->logrosintermedios = $request->logrosintermedios;
        $anex4->nivelogro = $request->nivelogro;
        $anex4->valorasignado = $request->valorasignado;
        $anex4->pesoasignado = $request->pesoasignado;
        $anex4->nivelogroalcanzado = $request->nivelogroalcanzado;
        $anex4->puntuacion = $request->puntuacion;
        $anex4->save();

        $actividades = MetasIndividuales::where('detalle_id', '=', $request->detalle_id)->orderBy('dia')->get();

         return ['actividades' => $actividades,'detalle_id' => $request->detalle_id ];

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $detalle = MetasIndividuales::where('id', '=', $id)->first();

        return ['detalle' => $detalle,'detalle_id' => $id ];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $metasActivi = MetasIndividuales::find($id);
        $metasActivi->actividad = $request->actividad;
        $metasActivi->dia = $request->dia;
        $metasActivi->horas = $request->horas;
        $metasActivi->objetivo = $request->objetivo;
        $metasActivi->meta = $request->meta;
        $metasActivi->evidencia = $request->evidencia;
        $metasActivi->logrosintermedios = $request->logrosintermedios;
        $metasActivi->nivelogro = $request->nivelogro;
        $metasActivi->nivelogroalcanzado = $request->nivelogroalcanzado;
        $metasActivi->puntuacion = $request->puntuacion;
        $metasActivi->valorasignado = $request->valorasignado;
        $metasActivi->pesoasignado = $request->pesoasignado;
        $metasActivi->save();

         $actividades = MetasIndividuales::where('detalle_id', '=', $request->detalle_id)->orderBy('dia')->get();

         return ['actividades' => $actividades,'detalle_id' => $request->detalle_id ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $detaActivi=MetasIndividuales::where('id',$id)->first();
        MetasIndividuales::find($id)->delete();

        $actividades = MetasIndividuales::where('detalle_id', '=', $detaActivi->detalle_id)->get();

         return ['actividades' => $actividades,'detalle_id' => $detaActivi->detalle_id ];
    }
}
