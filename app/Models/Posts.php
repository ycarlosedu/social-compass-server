<?php

namespace App\Models;

use App\Models\CustomModel;
use App\Models\Relatorios\RelatoriosCertificacaoEquipamentos;
use App\Models\Relatorios\RelatoriosPreventivaEquipamentos;

class Posts extends CustomModel
{
    protected $table = 'posts';

    public function usuario() {
        return $this->hasOne(Usuarios::class, 'id', 'usuario_id');
    }

    public function comentarios() {
        return $this->hasMany(RelatoriosCertificacaoEquipamentos::class);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'usuario_id', 'texto', 'localizacao', 'imagem', 'likes'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

}
