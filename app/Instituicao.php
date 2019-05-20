<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Instituicao extends Model
{
    protected $table = 'tab_instituicao_ensino';
    public $timestamps = false;
    protected $fillable = [
        'razao_social',
        'descricao',
        'campus',
        'endereco',
        'bairro',
        'cep',
        'uf',
        'telefone',
        'cnpj',
        'representada_por',
        'cargo',
        'responsavel_estagio',
        'cargo1'
    ];
}
