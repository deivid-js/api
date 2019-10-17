<?php

namespace App\Http\Traits;

/**
 *
 * @author Deivid
 */
trait LoadModelFromRequestTrait {
    
    public function loadModelFromRequest($fields, &$model, $request, $ignoredFields = []) {
        $updates = 0;
        
        foreach ($fields as $field) {
            $toReplace = $request->input($field);
            
            if (!is_null($toReplace) && trim($toReplace) != '' && !in_array($field, $ignoredFields)) {
                $updates += $model->$field != $toReplace ? 1 : 0;
                $model->$field = $toReplace;
            }
        }
        
        return $updates > 0;
    }
    
}
