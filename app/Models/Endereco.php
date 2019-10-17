<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Endereco extends Model {
    
    public $timestamps = false;
    
    protected $table = 'tbendereco';
    
    protected $primaryKey = 'endcodigo';
    
    protected $fillable = [
        'endcodigo',
        'psocodigo',
        'endestado',
        'endcidade',
        'endbairro',
        'endlogradouro',
        'endnumero',
        'endcomplemento',
        'endreferencia',
        'endobservacao'
    ];
    
}
