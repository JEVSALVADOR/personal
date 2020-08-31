<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Personal extends Model
{
    public $timestamps = true;
    protected $table = 'personal';
    protected $fillable = ['apellidosnombres', 'dni', 'edad', 'genero', 'escalafon', 'reglaboral', 'dependencia', 'cargo', 'direccion', 'celular', 'email', 'activo', 'borrado', 'sede_id', 'emailpj', 'familiaremerg', 'celfamiliaremerg','vulnerable', 'descvulnerable', 'factoriesgo', 'descfactoriesgo'];
    protected $guarded = ['id'];
    
    public function sede(){

            return $this->belongsTo(Sede::class,'sede_id');         
    }
    public function anexo04(){

        return $this->hasMany(App\Anexo04::class);         
    }
    public function users(){

        return $this->hasMany(App\User::class);         
    }
}
