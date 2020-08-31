<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Personal;
use App\Anexo04;
use App\Actividad;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class Anexo04Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $buscar=$request->buscar;

        $anexos4=DB::table('anexo04')
                ->join('personal', 'anexo04.evaluado_id', '=', 'personal.id')
                ->where('anexo04.estado','=','0')
                ->where('anexo04.evaluado_id','=',Auth::user()->personal_id)
                ->where(function($query) use ($buscar){
                    $query->orWhere('anexo04.fec_ini', 'like', '%'.$buscar.'%');
                    $query->orWhere('anexo04.fec_fin', 'like', '%'.$buscar.'%');
                })
                ->orderBy('anexo04.fec_ini','desc')
                ->select('anexo04.id', DB::RAW('date_format(anexo04.fec_ini,"%d-%m-%Y") as fec_ini'), DB::RAW('date_format(anexo04.fec_fin,"%d-%m-%Y") as fec_fin'), 'anexo04.fec_fijacion_metas', 'anexo04.evaluador_id', 'anexo04.evaluado_id', 'anexo04.estado')->paginate(20);

        return ['pagination'=> [
                'total'         => $anexos4->total(),
                'current_page'  => $anexos4->currentPage(),
                'per_page'      => $anexos4->perPage(),
                'last_page'     => $anexos4->lastPage(),
                'from'          => $anexos4->firstItem(),
                'to'            => $anexos4->lastItem(),
                ],
                'anexos4' => $anexos4

                ];
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
        $anex4 = new Anexo04;
        $anex4->fec_ini = $request->fec_ini;
        $anex4->fec_fin = $request->fec_fin;
        $anex4->evaluado_id = Auth::user()->personal_id;
        $anex4->estado = 0;
        $anex4->archivo = '';
        $anex4->save();

        $idanex4 = Anexo04::max('id');

        for ($i=1; $i <= intval($request->cantdias); $i++) {
            
            $actividad="actividad".$i; 
            $productosalcanzados="productosalcanzados".$i;
            $tiempo="tiempo".$i;
            $fecha="fecha".$i;

            $activi = new Actividad;
            $activi->actividad = $request->$actividad;
            $activi->fecha = $request->$fecha;
            $activi->tiempo = $request->$tiempo;
            $activi->anexo04_id = $idanex4;
            $activi->productosalcanzados = $request->$productosalcanzados;
            $activi->save();

        }

        $anexos4=DB::table('anexo04')
                ->join('personal', 'anexo04.evaluado_id', '=', 'personal.id')
                ->where('anexo04.estado','=','0')
                ->where('anexo04.evaluado_id','=',Auth::user()->personal_id)
                ->orderBy('anexo04.fec_ini','desc')
                ->select('anexo04.id',  DB::RAW('date_format(anexo04.fec_ini,"%d-%m-%Y") as fec_ini'), DB::RAW('date_format(anexo04.fec_fin,"%d-%m-%Y") as fec_fin'), 'anexo04.fec_fijacion_metas', 'anexo04.evaluador_id', 'anexo04.evaluado_id', 'anexo04.estado')->paginate(20);

        return ['pagination'=> [
                'total'         => $anexos4->total(),
                'current_page'  => $anexos4->currentPage(),
                'per_page'      => $anexos4->perPage(),
                'last_page'     => $anexos4->lastPage(),
                'from'          => $anexos4->firstItem(),
                'to'            => $anexos4->lastItem(),
                ],
                'anexos4' => $anexos4

                ];
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($dni)
    {
        return response()->json(["view"=>view('paginas.anexo04.index')->render()]);
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
        $actividad='';
        $totdias=0;

        $anexo4=Anexo04::select('id',DB::RAW('date_format(fec_ini,"%d-%m-%Y") as fec_ini'), DB::RAW('date_format(fec_fin,"%d-%m-%Y") as fec_fin'), 'evaluado_id', 'estado')->where('id',$id)->first();

        if ($anexo4==null) {
           $resultado=0;
        }else{
            $actividad=Actividad::select('id', 'actividad', DB::RAW('date_format(fecha,"%d-%m-%Y") as fecha'), 'tiempo', 'anexo04_id', 'nivelogroesperado', 'nivelogroalcanzado', 'productosalcanzados')->where('anexo04_id',$anexo4->id)->get();
            $totdias=count($actividad);
        }
 
        return ['anexo4' => $anexo4,'actividad' => $actividad,'resultado' => $resultado,'totdias' => $totdias];
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

        for ($i=1; $i <= intval($request->cantdiasedit); $i++) {
            
            $id="idactividad".$i; 
            $actividad="actividad".$i; 
            $tiempo="tiempo".$i;
            $productosalcanzados="productosalcanzados".$i;

            $actiUpdate = Actividad::find($request->$id);
            $actiUpdate->actividad = $request->$actividad;
            $actiUpdate->tiempo = $request->$tiempo;
            $actiUpdate->productosalcanzados = $request->$productosalcanzados;
            $actiUpdate->save();

        }

        $anexos4=DB::table('anexo04')
                ->join('personal', 'anexo04.evaluado_id', '=', 'personal.id')
                ->where('anexo04.estado','=','0')
                ->where('anexo04.evaluado_id','=',Auth::user()->personal_id)
                ->orderBy('anexo04.fec_ini','desc')
                ->select('anexo04.id',  DB::RAW('date_format(anexo04.fec_ini,"%d-%m-%Y") as fec_ini'), DB::RAW('date_format(anexo04.fec_fin,"%d-%m-%Y") as fec_fin'), 'anexo04.fec_fijacion_metas', 'anexo04.evaluador_id', 'anexo04.evaluado_id', 'anexo04.estado')->paginate(20);

        return ['pagination'=> [
                'total'         => $anexos4->total(),
                'current_page'  => $anexos4->currentPage(),
                'per_page'      => $anexos4->perPage(),
                'last_page'     => $anexos4->lastPage(),
                'from'          => $anexos4->firstItem(),
                'to'            => $anexos4->lastItem(),
                ],
                'anexos4' => $anexos4

                ];

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        DB::table('actividades')->where('anexo04_id', '=', $id)->delete();
        Anexo04::find($id)->delete();
        
        $anexos4=DB::table('anexo04')
                ->join('personal', 'anexo04.evaluado_id', '=', 'personal.id')
                ->where('anexo04.estado','=','0')
                ->where('anexo04.evaluado_id','=',Auth::user()->personal_id)
                ->orderBy('anexo04.fec_ini','desc')
                ->select('anexo04.id',  DB::RAW('date_format(anexo04.fec_ini,"%d-%m-%Y") as fec_ini'), DB::RAW('date_format(anexo04.fec_fin,"%d-%m-%Y") as fec_fin'), 'anexo04.fec_fijacion_metas', 'anexo04.evaluador_id', 'anexo04.evaluado_id', 'anexo04.estado')->paginate(20);

        return ['pagination'=> [
                'total'         => $anexos4->total(),
                'current_page'  => $anexos4->currentPage(),
                'per_page'      => $anexos4->perPage(),
                'last_page'     => $anexos4->lastPage(),
                'from'          => $anexos4->firstItem(),
                'to'            => $anexos4->lastItem(),
                ],
                'anexos4' => $anexos4

                ];


    }

    public function generarFicha04($id)
    {   
        
        $anexo04 = Anexo04::where('id', '=', $id)->first();
        $evaluado = Personal::where('id', '=', $anexo04->evaluado_id)->first();
        $actividades = Actividad::where('anexo04_id', '=', $anexo04->id)->get();


        $date = Carbon::now();
        $fecha = $date->format('d-m-Y');
        $hora = $date->format('H:i:s');


        // return view('paginas.anexo04.anexo04pdf',compact('anexo04','evaluado','actividades','fecha','hora'));

        $pdf = \PDF::loadView('paginas.anexo04.anexo04pdf',compact('anexo04','evaluado','actividades','fecha','hora'));

        return $pdf->stream('reporte');

    }
}
