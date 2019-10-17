<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pessoa extends Model {
    
    public $timestamps = false;
    
    protected $table = 'tbpessoa';
    
    protected $primaryKey = 'psocodigo';
    
    protected $fillable = ['psocodigo', 'psonome', 'psocpfcnpj', 'psotipo'];
    
}
