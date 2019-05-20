<?php

namespace App\Http\Controllers;
use App\Instituicao;

use Illuminate\Http\Request;

class InstituicaoController extends Controller
{
    public function getInstituicao() {
        return Instituicao::all();
    }

    public function setInstituicao(Request $request) {
        $faculdade = Instituicao::create([
            'id'=>$request->input('id'),
            'razao_social'=>$request->input('razao_social'),
            'descricao'=>$request->input('descricao'),
            'campus'=>$request->input('campus'),
            'endereco'=>$request->input('endereco'),
            'bairro'=>$request->input('bairro'),
            'cep'=>$request->input('cep'),
            'uf'=>$request->input('uf'),
            'telefone'=>$request->input('telefone'),
            'cnpj'=>$request->input('cnpj'),
            'representada_por'=>$request->input('representada_por'),
            'cargo'=>$request->input('cargo'),
            'responsavel_estagio'=>$request->input('responsavel_estagio'),
            'cargo1'=>$request->input('cargo1')
        ]);

        return $faculdade;
    }
}
