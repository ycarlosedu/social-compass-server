<?php

namespace App\Models;

use App\Models\CustomModel;
use App\Models\Relatorios\RelatoriosCertificacaoEquipamentos;
use App\Models\Relatorios\RelatoriosPreventivaEquipamentos;

class Comentarios extends CustomModel
{
    protected $table = 'comentarios';

    public function usuario() {
        return $this->hasOne(Usuarios::class, 'id', 'usuario_id');
    }

    public function post() {
        return $this->hasOne(Posts::class, 'id', 'post_id');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'usuario_id', 'post_id', 'texto'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

}
