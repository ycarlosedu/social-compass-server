<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use App\Models\Usuarios;
use Illuminate\Http\Request;

class PostsController extends Controller
{

    public function buscaTodos()
    {
        return response()->json(Posts::with(['usuario'])->get());
    }

    public function buscaUm($id)
    {
        return response()->json(Posts::find($id));
    }

    public function criar(Request $request)
    {
        $this->validate($request, [
            'usuario_id' => 'required',
            'texto' => 'required|max:255',
        ]);

        $Post = Posts::create($request->all());

        return response()->json($Post, 200);
    }

    public function atualizar($id, Request $request)
    {
        $this->validate($request, [
            'texto' => 'required|max:255',
        ]);

        $Post = Posts::find($id);
        $Post->update($request->all());

        return response()->json($Post, 200);
    }

    public function curtir($id)
    {
        $Post = Posts::find($id);
        $Post->update([
            'likes' => $Post->likes + 1
        ]);

        return response()->json($Post, 200);
    }

    public function deletar($id)
    {
        $Post = Posts::find($id);
        $Post->delete();

        return response()->json(['msg' => "Post deletado"], 200);
    }
}
