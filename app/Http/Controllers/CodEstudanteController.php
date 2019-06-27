<?php

namespace App\Http\Controllers;
Use App\CodEstudante;

use Illuminate\Http\Request;

class CodEstudanteController extends Controller
{
    public function getCodById(CodEstudante $cod_estudante) {
        return $cod_estudante;
    }
}
