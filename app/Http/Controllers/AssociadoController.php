<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\SaqueController;
use App\Models\Associado;
use App\Models\RendimentoBaseMes;
use App\Models\Comissao;
use Illuminate\Database\QueryException;


class AssociadoController extends Controller
{

     public function getAll()
    {
        $associados = Associado::all();
        $comissoes = $this->commissionList();
        $saques = SaqueController::getAll();
        $taxa = RendimentoBaseMes::first();
        
        return view('listAssociates')
                    ->with('associados',$associados)
                    ->with('comissoes', $comissoes)
                    ->with('saques', $saques)
                    ->with('taxa',$taxa);
    }

    public function create()
    {
        $response = view('formAssociate');
        return $response;
        
    }

    public function store(Request $request)
    {
        $request = $request->all();
        $usuario = new UsuarioController;
        $newUser = $usuario ->store($request);
        $request['user_id'] = $newUser;
        $associado = Associado::create($request);
        $response =  redirect('/');
        return $response;
                
    }

    public function show($id)
    {
        $associado = Associado::where('id', $id)->get();
        return view('showAssociate')->with('associado',$associado);
         
    }

    public function edit($user_id)
    {
        $associado = Associado::where('user_id', $user_id)->get();
        
        return view('formEditAssociate', ['associado' => $associado]);
    }

    public function update(Request $request, $id)
    {
        $request= $request->all();
        $updateAssociado = Associado::find($id);
        $updateAssociado->update($request);
        return redirect('/');   
    }

    public function updatePassword($request, $id)
    {

    }

    public function delete($id)
    {
    }

    public function getById($id)
    {
        $associate = Associado::find($id);
        return $associate;
    }

     public function commissionList()
    {
        $comissoes = Comissao::all();
        
        if(isset($comissoes))
        return $comissoes;
        else 
        return $comissoes = '';
    }
}