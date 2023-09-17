<?php

namespace App\Models;

use App\Models\CustomModel;
use App\Models\Relatorios\RelatoriosCertificacaoEquipamentos;
use App\Models\Relatorios\RelatoriosPreventivaEquipamentos;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Hash;
use Laravel\Lumen\Auth\Authorizable;
use Tymon\JWTAuth\Contracts\JWTSubject;
// use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuids;

class Usuarios extends CustomModel implements AuthenticatableContract, AuthorizableContract, JWTSubject
{
    use Authenticatable, Authorizable, HasFactory, Uuids;

    protected $table = 'usuarios';

    public function posts() {
        return $this->hasMany(Posts::class, 'usuario_id', 'id')->with('comentarios');
    }

    public function comentarios() {
        return $this->hasMany(Comentarios::class, 'usuario_id', 'id');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nome', 'usuario', 'password', 'data_nascimento', 'sexo', 'telefone', 'email', 'endereco'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password'];

    public function getJWTIdentifier() {

        return $this->getKey();
    }

    public function getJWTCustomClaims() {

        return [];

    }

    public function setPasswordAttribute($val){
        $pass = Hash::make(($val));
        $this->attributes['password'] = $pass;
    }
}
