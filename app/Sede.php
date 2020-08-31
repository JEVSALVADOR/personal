<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sede extends Model
{
    public $timestamps = true;
    protected $table = 'sede';
    protected $fillable = ['descripcion', 'direccion', 'provincia', 'cod', 'activo', 'borrado'];
    protected $guarded = ['id'];
    
    public function personal(){

        return $this->hasMany(App\Personal::class);        
    }
}
