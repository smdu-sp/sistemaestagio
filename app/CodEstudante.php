<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CodEstudante extends Model
{
    protected $table = 'tab_cad_estagiarios';
    public $timestamps = false;
    protected $primaryKey = 'cod_estudante';
}
