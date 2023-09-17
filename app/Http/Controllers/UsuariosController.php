<?php

namespace App\Http\Controllers;

use App\Enums\TipoUsuario;
use App\Models\Usuarios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Enum;

class UsuariosController extends Controller
{

    public function buscaTodosUsuarios()
    {
        return response()->json(Usuarios::all());
    }

    public function buscaUmUsuario($id, Request $request)
    {
        $request['id'] = $id;
        $this->validate($request, [
            'id' => 'required|exists:usuarios,id',
        ]);

        return response()->json(Usuarios::with(['posts'])->find($id));
    }

    public function atualizarUsuario($id, Request $request)
    {
        $request['id'] = $id;
        $this->validate($request, [
            'id' => 'required|exists:usuarios,id',
            'nome' => 'max:255',
            'usuario' => 'max:255|unique:usuarios,usuario',
            'data_nascimento' => 'max:255',
            'password' => 'max:50',
            'sexo' => 'max:50',
            'endereco' => 'max:50',
            'telefone' => 'max:50',
            'email' => 'email|unique:usuarios,email',
        ]);

        $User = Usuarios::find($id);
        $User->update($request->only('nome', 'usuario', 'data_nascimento', 'password', 'sexo', 'endereco', 'telefone', 'email'));

        return response()->json($User, 200);
    }

    public function deletar($id, Request $request)
    {
        $request['id'] = $id;
        $this->validate($request, [
            'id' => 'required|exists:usuarios,id',
        ]);

        $User = Usuarios::find($id);
        $User->delete();

        return response()->json(['msg' => 'Usuário deletado!'], 200);
    }
}
