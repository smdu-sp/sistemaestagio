<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{
    protected $table = 'tab_cargo_supervisor';
    public $timestamps = false;
    public $incrementing = false;
    protected $fillable = [
        'nome',
        'rf',
        'departamento',
        'cargo_funcao',
        'formacao',
        'conselho_profissional',
        'tel_contato',
        'e_mail',
        'atividade_estagiario',
        'situacao',
        'cpf'
    ];
}
