<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Personal;
use App\FichaEvaluacion;
use App\ParametrosEvaluacion;
use DB;
use Carbon\Carbon;
class FichaEvaluacionController extends Controller
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
    public function create($tipopersonal)
    {
        $fechaActual = Carbon::now();
        $fechaActual = $fechaActual->format('d-m-Y');

        $competencias = ParametrosEvaluacion::select('id', 'nro', 'descripcion', 'tipoevaluacion', 'activo', 'borrado', 'created_at', 'updated_at', 'tipopersonal', 'categoria',DB::raw('"1" as puntosc'))->where('tipoevaluacion', '=', 'c')->where('tipopersonal', '=', $tipopersonal)->where('activo', '1')->where('borrado', '0')->get();
        
        $habilidades = ParametrosEvaluacion::select('id', 'nro', 'descripcion', 'tipoevaluacion', 'activo', 'borrado', 'created_at', 'updated_at', 'tipopersonal', 'categoria',DB::raw('"1" as puntosh'))->where('tipoevaluacion', '=', 'h')->where('tipopersonal', '=', $tipopersonal)->where('activo', '1')->where('borrado', '0')->get();

        // dd($competencias);

        return ['competencias' => $competencias,'habilidades' => $habilidades,'fechaActual' => $fechaActual];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($dni)
    {
        $resultado=1;
        $personalacargo='';

        $personal = Personal::where('dni', '=', $dni)->first();
        
        if ($personal==null) {
           $resultado=0;
        }else{
            
            $personalacargo = Personal::where('dependencia', '=', $personal->dependencia)
            ->where(function ($query) {
                    $query->where('jeferesponsable', '<>', '1')
                          ->Where('jeferesponsable', '<>', '2');
                })
            ->get();
        }



         return [
                'personal' => $personal,
                'resultado' => $resultado,
                'personalacargo' => $personalacargo
                ];
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $resultado=1;

        $evaluado = Personal::where('id', '=', $id)->first();
        $fichasEvaluado = FichaEvaluacion::where('evaluado_id', '=', $evaluado->id)->orderBy('fecha')->get();

        if ($evaluado==null) {
           $resultado=0;
        }
        return ['evaluado' => $evaluado,'fichasEvaluado' => $fichasEvaluado,'resultado' => $resultado ];
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
