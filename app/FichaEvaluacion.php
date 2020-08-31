<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FichaEvaluacion extends Model
{
    public $timestamps = true;
    protected $table = 'fichaevaluaciondt';
    protected $fillable = ['fecha', 'metasproxevaluacion', 'capacitacion', 'archivo', 'estado', 'activo', 'borrado', 'subtotalcompetencias', 'subtotalhabilidades', 'promediogeneral', 'evaluador_id', 'evaluado_id'];
    protected $guarded = ['id'];
    
    public function detalleEvaluacion(){

        return $this->hasMany(App\DetalleEvaluacion::class);         
    }
    public function evaluador(){

            return $this->belongsTo(Personal::class,'evaluador_id');         
    }
    public function evaluado(){

            return $this->belongsTo(Personal::class,'evaluado_id');         
    }
}
