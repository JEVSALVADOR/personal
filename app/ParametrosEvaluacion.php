<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ParametrosEvaluacion extends Model
{
    public $timestamps = true;
    protected $table = 'parametros_evaluacion';
    protected $fillable = ['nro', 'descripcion', 'tipoevaluacion', 'activo', 'borrado', 'tipopersonal', 'categoria'];
    protected $guarded = ['id'];
    
    public function detalleEvaluacion(){

        return $this->hasMany(App\DetalleEvaluacion::class);         
    }

}
