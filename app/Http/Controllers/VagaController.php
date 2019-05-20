<?php

namespace App\Http\Controllers;
use App\Vaga;

use Illuminate\Http\Request;

class VagaController extends Controller
{
    public function getVagas() {
        return Vaga::all();
    }

    public function getVagasById(Vaga $id) {
        return $id;
    }

    public function setVaga(Request $request) {
        $vaga = Vaga::create([
            'id'=>$request->input('id'),
            'situacao'=>$request->input('situacao'),
            'dep_hierarquico'=>$request->input('dep_hierarquico'),
            'sigla'=>$request->input('sigla'),
            'historico'=>$request->input('historico'),
            'status'=>$request->input('status'),
            'anexos'=>$request->input('anexos')
        ]);

        return $vaga;
    }

    public function update(Request $request, Vaga $id) {
        $id->id = $request->input('id');
        $id->situacao = $request->input('situacao');
        $id->dep_hierarquico = $request->input('dep_hierarquico');
        $id->sigla = $request->input('sigla');
        $id->historico = $request->input('historico');
        $id->status = $request->input('status');
        $id->anexos = $request->input('anexos');
        $id->save();
        
        return $id;
    }

    public function delete(Vaga $id) {
        $id->delete();

        return $id;
    }
}
