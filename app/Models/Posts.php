<?php

namespace App\Models;

use App\Models\CustomModel;

class Posts extends CustomModel
{
    protected $table = 'posts';

    public function usuario() {
        return $this->hasOne(Usuarios::class, 'id', 'usuario_id');
    }

    public function comentarios() {
        return $this->hasMany(Comentarios::class, 'post_id', 'id')->with('usuario');
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
