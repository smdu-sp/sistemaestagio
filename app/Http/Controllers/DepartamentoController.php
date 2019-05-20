<?php

namespace App\Http\Controllers;
use App\Departamento;

use Illuminate\Http\Request;

class DepartamentoController extends Controller
{
    public function getDepartamentos() {
        return Departamento::all();
    }

    public function getDepartamentoById(Departamento $eh) {
        return $eh;
    }

    public function setDepartamento(Request $request) {
        $departamentos = Departamento::create([
            'eh'=>$request->input('eh'),
            'secretaria'=>$request->input('secretaria'),
            'departamentos'=>$request->input('departamentos'),
            'divisoes_assessorias'=>$request->input('divisoes_assessorias'),
            'sigla'=>$request->input('sigla'),
            'tipo'=>$request->input('tipo'),
            'situacao'=>$request->input('situacao')
        ]);
        return $departamentos;
    }

    public function update(Request $request, Departamento $eh) {
        $eh->eh = $request->input('eh');
        $eh->secretaria = $request->input('secretaria');
        $eh->departamentos = $request->input('departamentos');
        $eh->divisoes_assessorias = $request->input('divisoes_assessorias');
        $eh->sigla = $request->input('sigla');
        $eh->tipo = $request->input('tipo');
        $eh->situacao = $request->input('situacao');
        $eh->save();

        return $eh;
    }

    public function delete(Departamento $eh) {
        $eh->delete();

        return $eh;
    }
}
