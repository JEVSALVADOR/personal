<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','activo', 'borrado', 'tipo_user_id', 'personal_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function personal(){

            return $this->belongsTo(Personal::class,'personal_id');         
    }
    
    public function tipouser(){

            return $this->belongsTo(TipoUser::class,'tipo_user_id');         
    }
}
