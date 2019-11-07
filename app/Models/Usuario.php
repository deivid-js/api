<?php

namespace App\Models;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Usuario extends Authenticatable implements JWTSubject {
    
    use Notifiable;

    public $timestamps = false;
    
    public $incrementing = false;

    protected $hidden = ['ususenha'];
    
    protected $table = 'tbusuario';
    
    protected $primaryKey = 'usucodigo';

    const CREATE_AT = 'usudatahorainsercao';

    const UPDATED_AT = 'usudatahoramodificacao';
    
    protected $fillable = [
        'psocodigo',
        'usuemail',
        'ususenha',
        'usuativo'
    ];
    
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
