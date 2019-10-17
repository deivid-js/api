<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pessoa;
use Illuminate\Support\Facades\Validator;
use App\Http\Traits\ParamErrorTrait;
use App\Http\Traits\LoadModelFromRequestTrait;

class PessoaController extends Controller {
    
    use ParamErrorTrait, LoadModelFromRequestTrait;
    
    /**
     * 
     * @return type
     */
    public function index() {
        $data = Pessoa::orderBy('psocodigo')->get();
        
        return response()->json([
            'message' => 'Ok',
            'data'    => $data
        ]);
    }
    
    /**
     * 
     * @param Request $request
     * @return type
     */
    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'psonome'    => 'required|max:100',
            'psocpfcnpj' => 'required|integer|max:14',
            'psotipo'    => 'required|max:1',
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Request error',
                'errors'  => $this->catchErrorsFromValidator($validator)
            ], 400);
        }
        
        $data = $request->only(['psonome', 'psocpfcnpj', 'psotipo']);
        
        if ($this->hasBeenRegistred($data['psocpfcnpj'])){
            return response()->json([
                'message' => 'Violated constraint <tbpessoa_psocpfcnpj_unique>'
            ], 400);
        } else if (!in_array($data['psotipo'], ['F', 'J'])) {
            return response()->json([
                'message' => 'Invalid param <psotipo>'
            ], 400);
        }
        
        Pessoa::create(array_merge($data, [
            'psocodigo' => Pessoa::max('psocodigo') + 1
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
            'psonome'    => 'max:100',
            'psocpfcnpj' => 'max:14',
            'psotipo'    => 'max:1',
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Request error',
                'errors'  => $this->catchErrorsFromValidator($validator)
            ], 400);
        }
        
        $model = Pessoa::find($id);
        
        if (!$model) {
            return response()->json([
                'message' => 'No data found'
            ], 404);
        }
        
        $hasUpdates = $this->loadModelFromRequest([
            'psonome', 'psocpfcnpj', 'psotipo'
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
        $model = Pessoa::find($id);
        
        if (!$model) {
            return response()->json([
                'message' => 'No data found'
            ], 404);
        }
        
        $model->delete();
        
        return response()->json(['message' => 'Removed']);
    }
    
    /**
     * 
     * @param type $cpfcnpj
     * @return type
     */
    private function hasBeenRegistred($cpfcnpj) {
        $data = Pessoa::where('psocpfcnpj', $cpfcnpj)->first();
        
        return !!$data;
    }
    
}
