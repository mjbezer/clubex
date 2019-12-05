<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Comissao;
use Illuminate\Database\QueryException;


class ComissaoController extends Controller
{

    public function index()
    {
        $comissoes = Comissao::all();

    }

    public function store(Request $request)
    { 
        $request = $request->all();
        $request['comissao'] = str_replace(',', '.', str_replace('.', '', $request['comissao']));
        $insertComissao = Comissao::create($request);
        return redirect('/associates');
    }

     public function getByAssociate($id)
    {
        $comissoes = Comissao::where('associado_id', $id)
                    ->where('associados')->get();
        return  $comissao;
    }

    public function update($request, $id)
    {
            $comissao = Comissao::find($id);
            $comissao->update($request);
    }

    public function destroy($id)
    {
        $comissao = Comissao::delete($id);

    }
}