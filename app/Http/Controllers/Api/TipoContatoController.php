<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\TipoContato;
use Illuminate\Support\Facades\Validator;
use App\Http\Traits\ParamErrorTrait;
use App\Http\Traits\LoadModelFromRequestTrait;

class TipoContatoController extends Controller {
    
    use ParamErrorTrait, LoadModelFromRequestTrait;
    
    /**
     * 
     * @return type
     */
    public function index() {
        $data = TipoContato::orderBy('tcocodigo')->get();
        
        return response()->json([
            'message' => 'Ok',
            'data'    => $data
        ]);
    }
    
    public function show($id) {
        return response()->json([
            'message' => 'Ok',
            'data'    => TipoContato::find($id)
        ]);
    }
    
    /**
     * 
     * @param Request $request
     * @return type
     */
    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'tcodescricao' => 'required'
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Request error',
                'errors'  => $this->catchErrorsFromValidator($validator)
            ], 400);
        }
        
        TipoContato::create([
            'tcocodigo'    => TipoContato::max('tcocodigo') + 1,
            'tcodescricao' => $request->input('tcodescricao')
        ]);
        
        return response()->json(['message' => 'Created']);
    }
    
    /**
     * 
     * @param Request $request
     * @param type $id
     * @return type
     */
    public function update(Request $request, $id) {
        $validator = Validator::make($request->all(), [
            'tcodescricao' => 'required'
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Request error',
                'errors'  => $this->catchErrorsFromValidator($validator)
            ], 400);
        }
        
        $model = TipoContato::find($id);
        
        if (!$model) {
            return response()->json([
                'message' => 'No data found'
            ], 404);
        }
        
        $hasUpdates = $this->loadModelFromRequest(['tcodescricao'], $model, $request);
        
        if (!$hasUpdates) {
            return response()->json([
                'message' => 'No changes found'
            ], 400);
        }
        
        $model->save();
        
        return response()->json(['message' => 'Updated']);
    }
    
    /**
     * 
     * @param type $id
     * @return type
     */
    public function destroy($id) {
        $model = TipoContato::find($id);
        
        if (!$model) {
            return response()->json([
                'message' => 'No data found'
            ], 404);
        }
        
        $model->delete();
        
        return response()->json(['message' => 'Removed']);
    }
    
}
