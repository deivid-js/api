<?php

namespace App\Models;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
//use App\Accessors\UsuarioAccessor;

class Usuario extends Authenticatable implements JWTSubject {
    
    use Notifiable /*, UsuarioAccessor */;
    
    public $timestamps = false;
    
    public $incrementing = false;
    
    protected $table = 'tbusuario';
    
    protected $primaryKey = 'usucodigo';
    
    protected $fillable = ['name'];
    
    /**
     * {@inheritdoc}
     */
    public function getJWTIdentifier() {
        return $this->getKey();
    }
    
    /**
     * {@inheritdoc}
     */
    public function getJWTCustomClaims() {
        return [];
    }
    
    public function setUsusenhaAttribute($password) {
        if ($password !== null & $password !== "") {
            $this->attributes['ususenha'] = bcrypt($password);
        }
    }
    
}
