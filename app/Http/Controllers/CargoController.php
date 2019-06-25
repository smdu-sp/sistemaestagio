<?php

namespace App\Http\Controllers;
use App\Cargo;

use Illuminate\Http\Request;

class CargoController extends Controller
{
    public function getCargo() {
        return Cargo::all();
    }
}
