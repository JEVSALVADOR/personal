<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Anexo04 extends Model
{
    public $timestamps = true;
    protected $table = 'anexo04';
    protected $fillable = ['fec_ini', 'fec_fin', 'fec_fijacion_metas', 'evaluador_id', 'evaluado_id', 'observaciones', 'fec_suscripcion', 'estado', 'archivo', 'promedionivlogro'];
    protected $guarded = ['id'];
     
    public function actividad(){

        return $this->hasMany(App\Actividad::class);         
    }
    public function evaluador(){

            return $this->belongsTo(Personal::class,'evaluador_id');         
    }
    public function evaluado(){

            return $this->belongsTo(Personal::class,'evaluado_id');         
    }
}
