<?php

namespace App\Models;

use App\Models\CustomModel;

class MarketplaceItens extends CustomModel
{
    protected $table = 'marketplace_itens';

    public function usuario() {
        return $this->hasOne(Usuarios::class, 'id', 'usuario_id');
    }

    public function comprador() {
        return $this->hasOne(Usuarios::class, 'id', 'comprador_id');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'usuario_id', 'comprador_id', 'nome', 'descricao', 'preco', 'imagem', 'vendido'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

}
