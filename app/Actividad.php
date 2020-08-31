<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Actividad extends Model
{
    public $timestamps = true;
    protected $table = 'actividades';
    protected $fillable = ['actividad', 'fecha', 'tiempo', 'anexo04_id', 'nivelogroesperado', 'nivelogroalcanzado','productosalcanzados'];
    protected $guarded = ['id'];
     
    public function anexo04(){

            return $this->belongsTo(Personal::class,'anexo04_id');         
    }
}
