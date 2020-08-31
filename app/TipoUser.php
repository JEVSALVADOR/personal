<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoUser extends Model
{
    public $timestamps = true;
    protected $table = 'tipo_user';
    protected $fillable = ['descripcion', 'detalle', 'activo', 'borrado'];
    protected $guarded = ['id'];
    
    public function user(){

        return $this->hasMany(App\User::class);        
    }
}
