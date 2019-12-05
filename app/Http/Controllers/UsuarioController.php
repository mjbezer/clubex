<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class UsuarioController extends Controller
{
    public function store($request)
    {
        $novo_email = $request['email'];
        $email = User::where('email', '=', "$novo_email")->first();
        if ($email) {
            $msg =  [
                'status' => 200,
                'msg' => 'E-mail já cadastrado!'
            ];
            return redirect()->back()->with('msg', $msg);
        } else {
                $usuario = User::create([
                    'name' => $request['nome'],
                    'email' => $request['email'],
                    'password' => Hash::make($request['password']),
                    'category' =>'0'
                ]);
            return $usuario->id;
         }
        
    }

    public function show($id)
    {
        $usuario = User::find($id);
        return $usuario;
    }

    public function editPassword($id)
    {
        
        return view('auth.alterPassword', ['id'=>$id]);
    }

    public function update(Request $request, $id)
    {
        try {
            $usuario = User::find($id);
            $usuario->update($request);
            return [
                'status' => 200,
                'msg' => 'Alteração realizada com sucesso!'
            ];
        } catch (Exception $e) {
            return [
                'status' => 300,
                'msg' => $e->getMessage()
            ];
        }
    }

    public function updatePassword(Request $request, $id)
    {
        $senha_atual = $request['senha_atual'];
        $usuario = User::where('id', '=', "$id")->first();
        if ($usuario) {
            $senha = Hash::check($senha_atual, $usuario->password);
            if ($senha) {
                try {
                    $usuario->password = Hash::make($request['nova_senha']);
                    $usuario->save();
                    $msg = ['title' =>'Sucesso',
                            'text' => 'Senha Alterada com Sucesso',
                            'icon' =>'success'];

                    return redirect('/')->with('msg', $msg);
                } catch (Exception $e) {
                     $msg = ['title' =>'Erro',
                            'text' => $e->getMessage(),
                            'icon' =>'error'];
                       
                       return redirect()->back()->with('msg', $msg);
                }
            } else {
                     $msg = ['title' =>'Alerta',
                            'text' => 'Senha atual informada com coincide com a senha gravada!',
                            'icon' =>'warning'];
                    return redirect()->back()
                    ->with('msg', $msg);
            }
        }
    }

    public function delete($id)
    {
        try {
            $usuario = User::find($id);
            $usuario->delete();
            return [
                'status' => 200,
                'msg' => 'Registro excluido com sucesso!'
            ];
        } catch (Exception $e) {
            return [
                'status' => 300,
                'msg' => $e->getMessage()
            ];
        }
    }
}