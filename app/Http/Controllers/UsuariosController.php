<?php

namespace App\Http\Controllers;

use App\Enums\TipoUsuario;
use App\Models\Usuarios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Enum;

class UsuariosController extends Controller
{

    public function BuscaTodosUsuarios()
    {
        $AttributesToShowInTable = config('constants.UsersAttributesToShowInTable');
        return response()->json(Usuarios::all($AttributesToShowInTable));
    }

    public function buscaUmUsuario($id)
    {
        return response()->json(Usuarios::find($id));
    }

    // DEPRECATED
    // public function criar(Request $request)
    // {
    //     $password = md5($request->request->get('usuario'));
    //     $request->request->set('password', $password);
    //     $this->validate($request, [
    //         'usuario' => 'required|unique:usuarios|max:50',
    //         'password' => 'required',
    //         'tipo' => 'required|max:3'
    //     ]);

    //     $Usuarios = Usuarios::create($request->all());

    //     return response()->json($Usuarios, 201);
    // }

    public function atualizarUsuarios($codigo, Request $request)
    {
        $this->validate($request, [
            'usuario' => 'unique:usuarios|max:50',
            'tipo' => [new Enum(TipoUsuario::class)],
        ]);
        $AttributesToShowInTable = config('constants.UsersAttributesToShowInTable');

        $Usuarios = Usuarios::query()
        ->where('codigo', '=', "{$codigo}");
        $Usuarios->update($request->all());

        $User = $Usuarios->get($AttributesToShowInTable)[0];

        return response()->json($User, 200);
    }

    public function atualizarPerfilUsuario($id, Request $request)
    {
        $this->validate($request, [
            'usuario' => 'unique:usuarios|max:50',
            'tipo' => [new Enum(TipoUsuario::class)],
        ]);
        $Usuarios = Usuarios::findOrFail($id);
        $Usuarios->update($request->all());

        return response()->json($Usuarios, 200);
    }

    public function atualizarSenhaUsuario($id, Request $request)
    {
        $Usuarios = Usuarios::findOrFail($id);
        $Usuarios->makeVisible(['password']);

        $oldPass = $request->request->all()['senhaAtual'];

        if (!Hash::check($oldPass, $Usuarios->password)) {
            return response()->json('Senha enviada não confere!', 402);
        }

        $this->validate($request, [
            'senhaAtual' => 'min:8|max:20|required',
            'senhaNova' => 'min:8|max:20|required|different:senhaAtual',
            'confirmSenhaNova' => 'min:8|max:255|required|same:senhaNova',
        ]);

        $newPass = $request->request->all()['senhaNova'];
        $Usuarios->setPasswordAttribute($newPass);
        $Usuarios->save();

        return response('Atualizado com sucesso!', 200);
    }

    public function deletar($codigo)
    {
        // Usuarios::findOrFail($codigo)->delete();
        Usuarios::query()
        ->where('codigo', '=', "{$codigo}")
        ->delete();
        return response('Deleted Successfully', 200);
    }
}
