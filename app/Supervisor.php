<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supervisor extends Model
{
    protected $table = 'tab_supervisores';
    protected $primaryKey = 'rf';
    public $timestamps = false;
    protected $fillable = [
        'nome',
        'rf',
        'departamento',
        'cargo_funcao',
        'formacao',
        'conselho_profissional',
        'tel_contato',
        'e_mail',
        'atividades_estagiario',
        'situacao',
        'cpf'
    ];
}
