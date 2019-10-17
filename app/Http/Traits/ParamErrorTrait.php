<?php

namespace App\Http\Traits;

/**
 *
 * @author Deivid
 */
trait ParamErrorTrait {
    
    private function catchErrorsFromValidator(\Illuminate\Validation\Validator $validator) {
        $withError = [];
        
        foreach ($validator->errors()->getMessages() as $column => $error) {
            $withError[] = "Invalid param <{$column}>";
        }
        
        return $withError;
    }
    
}
