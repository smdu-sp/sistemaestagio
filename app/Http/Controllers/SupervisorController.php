<?php

namespace App\Http\Controllers;
use App\Supervisor;

use Illuminate\Http\Request;

class SupervisorController extends Controller
{
    public function getSupervisores() {
        return Supervisor::all();

    }

    public function getSupervisorByName(Supervisor $nome) {
        return $nome;
    }

    public function setSupervisor(Request $request) {
        $supervisor = Supervisor::create([
            'nome'=>$request->input('nome'),
            'rf'=>$request->input('rf'),
            'departamento'=>$request->input('departamento'),
            'cargo_funcao'=>$request->input('cargo_funcao'),
            'formacao'=>$request->input('formacao'),
            'conselho_profissional'=>$request->input('conselho_profissional'),
            'tel_contato'=>$request->input('tel_contato'),
            'e_mail'=>$request->input('e_mail'),
            'atividades_estagiario'=>$request->input('atividades_estagiario'),
            'situacao'=>$request->input('situacao'),
            'cpf'=>$request->input('cpf')
        ]);

        return $supervisor;        
    }

    public function update(Request $request, Supervisor $rf) {
        $rf->nome = $request->input('nome');
        $rf->rf = $request->input('rf');
        $rf->departamento = $request->input('departamento');
        $rf->cargo_funcao = $request->input('cargo_funcao');
        $rf->formacao = $request->input('formacao');
        $rf->conselho_profissional = $request->input('conselho_profissional');
        $rf->tel_contato = $request->input('tel_contato');
        $rf->e_mail = $request->input('e-mail');
        $rf->atividades_estagiario = $request->input('atividades_estagiario');
        $rf->situacao = $request->input('situacao');
        $rf->cpf = $request->input('cpf');
        $rf->save();

        return $rf;
    }

    public function delete(Supervisor $rf) {
        $rf->delete();

        return $rf;
    }
}
