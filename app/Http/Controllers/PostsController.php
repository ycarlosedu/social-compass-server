<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use App\Models\Usuarios;
use Illuminate\Http\Request;

class PostsController extends Controller
{

    public function buscaTodos()
    {
        return response()->json(Posts::with(['usuario', 'comentarios'])->get());
    }

    public function buscaUm($id, Request $request)
    {
        $request['id'] = $id;
        $this->validate($request, [
            'id' => 'required|exists:posts,id',
        ]);

        return response()->json(Posts::with(['usuario', 'comentarios'])->find($id));
    }

    public function criar(Request $request)
    {
        $request['likes'] = 0;

        $this->validate($request, [
            'usuario_id' => 'required',
            'texto' => 'required|max:255',
            'localizacao' => 'max:255',
        ]);

        $Post = Posts::create($request->only('usuario_id', 'texto', 'localizacao', 'likes', 'imagem'));

        return response()->json($Post, 200);
    }

    public function atualizar($id, Request $request)
    {
        $request['id'] = $id;
        $this->validate($request, [
            'texto' => 'required|max:255',
            'localizacao' => 'max:255',
            'id' => 'required|exists:posts,id',
        ]);

        $Post = Posts::find($id);
        $Post->update($request->only('texto', 'localizacao', 'imagem'));

        return response()->json($Post, 200);
    }

    public function curtir($id, Request $request)
    {
        $request['id'] = $id;
        $this->validate($request, [
            'id' => 'required|exists:posts,id',
        ]);

        $Post = Posts::find($id);
        $Post->update([
            'likes' => $Post->likes + 1
        ]);

        return response()->json($Post, 200);
    }

    public function deletar($id, Request $request)
    {
        $request['id'] = $id;
        $this->validate($request, [
            'id' => 'required|exists:posts,id',
        ]);

        $Post = Posts::find($id);
        $Post->delete();

        return response()->json(['msg' => "Post deletado!"], 200);
    }
}
