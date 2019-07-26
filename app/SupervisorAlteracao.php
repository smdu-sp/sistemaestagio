<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class SupervisorAlteracao extends Model
{
    protected $table = 'tab_supervisor_alteracao';
    public $timestamps = false;
    protected $fillable = [
        'supervisor_antigo',
        'supervisor_novo',
        'inicio_supervisao',
        'fim_supervisao',
        'duracao_supervisao_dias',
        'estagiario'
    ];
}
