<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cartao extends Model
{
    protected $table = 'tab_cartao_acesso';
    public $timestamps = false;
    public $incrementing = false;
    protected $fillable = [
        'id',
        'situacao',
        'observacoes'
    ];
}
