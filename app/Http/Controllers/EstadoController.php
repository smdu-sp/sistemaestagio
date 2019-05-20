<?php

namespace App\Http\Controllers;
use App\Estado;

use Illuminate\Http\Request;

class EstadoController extends Controller
{
    public function getEstado() {
        return Estado::all();
    }
}
