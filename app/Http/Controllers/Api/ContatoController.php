<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Models\TipoContato;
use App\Models\Contato;
use App\Models\Pessoa;
use Illuminate\Support\Facades\Validator;
use App\Http\Traits\ParamErrorTrait;
use App\Http\Traits\LoadModelFromRequestTrait;

class ContatoController extends ApiController {
    
    use ParamErrorTrait, LoadModelFromRequestTrait;
    
    /**
     * 
     * @return type
     */
    public function index() {
        $data = Contato::orderBy('tcocodigo')->get();
        
        return response()->json([
            'message' => 'Ok',
            'data'    => $data
        ]);
    }
    
    public function show($id) {
        return response()->json([
            'message' => 'Ok',
            'data'    => Contato::find($id)
        ]);
    }
    
    /**
     * 
     * @param Request $request
     * @return type
     */
    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'condescricao' => 'required|max:100',
            'psocodigo'    => 'required|integer',
            'tcocodigo'    => 'required|integer'
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Request error',
                'errors'  => $this->catchErrorsFromValidator($validator)
            ], 400);
        }
        
        $data = $request->only(['condescricao', 'psocodigo', 'tcocodigo']);
        
        $exists = Pessoa::find($data['psocodigo']);
        
        if (!$exists) {
            return response()->json([
                'message' => 'No data found <psocodigo>'
            ], 404);
        }
        
        $exists = TipoContato::find($data['tcocodigo']);
        
        if (!$exists) {
            return response()->json([
                'message' => 'No data found <tcocodigo>'
            ], 404);
        }
        
        Contato::create(array_merge($data, [
            'concodigo' => Contato::max('concodigo') + 1,
        ]));
        
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
            'condescricao' => 'max:100',
            'psocodigo'    => 'integer',
            'tcocodigo'    => 'integer'
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Request error',
                'errors'  => $this->catchErrorsFromValidator($validator)
            ], 400);
        }
        
        $model = Contato::find($id);
        
        if (!$model) {
            return response()->json([
                'message' => 'No data found'
            ], 404);
        }
        
        $hasUpdates = $this->loadModelFromRequest([
            'condescricao', 'psocodigo', 'tcocodigo'
        ], $model, $request);
        
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
        $model = Contato::find($id);
        
        if (!$model) {
            return response()->json([
                'message' => 'No data found'
            ], 404);
        }
        
        $model->delete();
        
        return response()->json(['message' => 'Removed']);
    }
    
}
