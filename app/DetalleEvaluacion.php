<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleEvaluacion extends Model
{
    public $timestamps = true;
    protected $table = 'detalle_evaluacion';
    protected $fillable = ['puntaje', 'fichaEvaluaciondt_id', 'parametros_evaluacion_id'];
    protected $guarded = ['id'];
    
    public function fichaEvaluacion(){

            return $this->belongsTo(Personal::class,'fichaEvaluaciondt_id');         
    }
    public function parametrosEvaluacion(){

            return $this->belongsTo(Personal::class,'parametros_evaluacion_id');         
    }
}
