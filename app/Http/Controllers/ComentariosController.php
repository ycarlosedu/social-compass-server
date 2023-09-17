<?php

namespace App\Http\Controllers;

use App\Models\Comentarios;
use Illuminate\Http\Request;

class ComentariosController extends Controller
{

    public function criar(Request $request)
    {
        $this->validate($request, [
            'usuario_id' => 'required|exists:usuarios,id',
            'post_id' => 'required|exists:posts,id',
            'texto' => 'required|max:255',
        ]);

        $Comentario = Comentarios::create($request->only('usuario_id', 'post_id', 'texto'));

        return response()->json($Comentario, 200);
    }

    public function atualizar($id, Request $request)
    {
        $request['id'] = $id;
        $this->validate($request, [
            'texto' => 'required|max:255',
            'id' => 'required|exists:comentarios,id',
        ]);

        $Comentario = Comentarios::find($id);
        $Comentario->update($request->only('texto'));

        return response()->json($Comentario, 200);
    }

    public function deletar($id, Request $request)
    {
        $request['id'] = $id;
        $this->validate($request, [
            'id' => 'required|exists:comentarios,id',
        ]);

        $Comentario = Comentarios::find($id);
        $Comentario->delete();

        return response()->json(['msg' => "Comentário deletado!"], 200);
    }
}
