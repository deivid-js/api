<?php

namespace App\Accessors;

trait UsuarioAccessor {
    
    public function getCodigoAttribute() {
        return $this->usucodigo;
    }
    
    /**
     * Criptografa a senha antes de salva no banco
     * 
     * @param string $password
     */
    public function setPasswordAttribute($password) {
        if ($password !== null & $password !== "") {
            $this->attributes['password'] = bcrypt($password);
        }
    }
    
}