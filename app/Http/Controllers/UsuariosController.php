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

    public function buscaUmUsuario($id)
    {
        return response()->json(Usuarios::find($id));
    }

    public function atualizarUsuario($id, Request $request)
    {
        $this->validate($request, [
            'email' => 'regex:/^.+@.+$/i|unique:usuarios',
        ]);

        $User = Usuarios::find($id);
        $User->update($request->all());

        return response()->json($User, 200);
    }
}
