<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vaga extends Model
{
    protected $table = 'tab_vagas_smdu';
    public $timestamps = false;
    public $incrementing = false;
    protected $fillable = [
        'id',
        'situacao',
        'dep_hierarquico',
        'sigla',
        'historico',
        'status',
        'anexos'
    ];
}
