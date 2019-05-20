<?php

namespace App\Http\Controllers;
use App\Cartao;

use Illuminate\Http\Request;

class CartaoController extends Controller
{
    public function getCartao() {
        return Cartao::all();
    }

    public function setCartao(Request $request) {
        $cartao = Cartao::create([
            'id'=>$request->input('id'),
            'situacao'=>$request->input('situacao'),
            'observacoes'=>$request->input('observacoes')
        ]);

        return $cartao;
    }

    public function update(Request $request, Cartao $id) {
        $id->id = $request->input('id');
        $id->situacao = $request->input('situacao');
        $id->observacoes = $request->input('observacoes');
        $id->save();
        
        return $id;
    }

    public function delete(Cartao $id) {
        $id->delete();

        return $id;
    }
}
