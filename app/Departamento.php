<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    protected $table = 'tab_setores_completo';
    public $timestamps = false;
    protected $fillable = [
        'eh',
        'secretaria',
        'departamentos',
        'divisoes_assessorias',
        'sigla',
        'tipo',
        'situacao'
    ];
}
