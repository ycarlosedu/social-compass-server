<?php

namespace App\Http\Controllers;

use App\Models\MarketplaceItens;
use App\Models\Usuarios;
use Illuminate\Http\Request;

class MarketController extends Controller
{

    public function buscaTodos()
    {
        $MarketItens = MarketplaceItens::all();
        foreach ($MarketItens as $MarketItem) {
            $MarketItem['vendido'] = !!$MarketItem['vendido'];
        }

        return response()->json($MarketItens);
    }

    public function buscaUm($id, Request $request)
    {
        $request['id'] = $id;
        $this->validate($request, [
            'id' => 'required|exists:marketplace_itens,id',
        ]);
        $MarketItem = MarketplaceItens::with(['usuario', 'comprador'])->find($id);
        $MarketItem['vendido'] = !!$MarketItem['vendido'];

        return response()->json($MarketItem);
    }

    public function criar(Request $request)
    {
        $request['vendido'] = false;
        $this->validate($request, [
            'usuario_id' => 'required',
            'nome' => 'required|max:255',
            'descricao' => 'required|max:500',
            'preco' => 'required|numeric',
        ]);

        $MarketItem = MarketplaceItens::create($request->only('usuario_id', 'nome', 'descricao', 'preco', 'imagem'));
        $MarketItem['vendido'] = false;

        return response()->json($MarketItem, 200);
    }

    public function atualizar($id, Request $request)
    {
        $request['id'] = $id;
        $this->validate($request, [
            'nome' => 'required|max:255',
            'descricao' => 'required|max:500',
            'preco' => 'required|numeric',
            'id' => 'required|exists:marketplace_itens,id',
        ]);

        $MarketItem = MarketplaceItens::find($id);
        $MarketItem->update($request->only('nome', 'descricao', 'preco', 'imagem'));
        $MarketItem['vendido'] = !!$MarketItem['vendido'];

        return response()->json($MarketItem, 200);
    }

    public function comprar($id, Request $request)
    {
        $request['id'] = $id;
        $this->validate($request, [
            'comprador_id' => 'required|exists:usuarios,id',
            'id' => 'required|exists:marketplace_itens,id',
        ]);

        $MarketItem = MarketplaceItens::find($id);
        $MarketItem->update([
            'comprador_id' => $request->comprador_id,
            'vendido' => true
        ]);

        return response()->json($MarketItem, 200);
    }

    public function deletar($id, Request $request)
    {
        $request['id'] = $id;
        $this->validate($request, [
            'id' => 'required|exists:marketplace_itens,id',
        ]);

        $MarketItens = MarketplaceItens::find($id);
        $MarketItens->delete();

        return response()->json(['msg' => "Item deletado!"], 200);
    }
}
