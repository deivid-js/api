<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoContato extends Model {
    
    public $timestamps = false;
    
    protected $table = 'tbtipocontato';
    
    protected $primaryKey = 'tcocodigo';
    
    protected $fillable = ['tcocodigo', 'tcodescricao'];
    
}
