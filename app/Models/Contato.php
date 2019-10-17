<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contato extends Model {

    public $timestamps = false;
    
    protected $table = 'tbcontato';
    
    protected $primaryKey = 'concodigo';
    
    protected $fillable = ['concodigo', 'condescricao', 'psocodigo', 'tcocodigo'];
    
}
