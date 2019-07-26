<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\SupervisorAlteracao;

class SupervisorAlteracaoController extends Controller
{
    public function setSupervisor(Request $request) {
        $supervisor = SupervisorAlteracao::create([
            'supervisor_antigo'=>$request->input('supervisor_antigo'),
            'supervisor_novo'=>$request->input('supervisor_novo'),
            'inicio_supervisao'=>$request->input('inicio_supervisao'),
            'fim_supervisao'=>$request->input('fim_supervisao'),
            'duracao_supervisao_dias'=>$request->input('duracao_supervisao_dias'),
            'estagiario'=>$request->input('estagiario')
        ]);

        return $supervisor;
    }
    
}
