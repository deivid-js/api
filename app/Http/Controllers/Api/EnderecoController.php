<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Models\Endereco;
use App\Models\Pessoa;
use Illuminate\Support\Facades\Validator;
use App\Http\Traits\ParamErrorTrait;
use App\Http\Traits\LoadModelFromRequestTrait;

class EnderecoController extends ApiController {
    
    use ParamErrorTrait, LoadModelFromRequestTrait;
    
    private $columns = [
        'psocodigo',
        'endestado',
        'endcidade',
        'endbairro',
        'endlogradouro',
        'endnumero',
        'endcomplemento',
        'endreferencia',
        'endobservacao'
    ];
    
    /**
     * 
     * @return type
     */
    public function index() {
        $data = Endereco::orderBy('endcodigo')->get();
        
        return response()->json([
            'message' => 'Ok',
            'data'    => $data
        ]);
    }
    
    public function show($id) {
        return response()->json([
            'message' => 'Ok',
            'data'    => Endereco::find($id)
        ]);
    }
    
    /**
     * 
     * @param Request $request
     * @return type
     */
    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'psocodigo'      => 'required|integer',
            'endestado'      => 'required|max:2',
            'endcidade'      => 'required|max:100',
            'endbairro'      => 'required|max:100',
            'endlogradouro'  => 'required|max:100',
            'endnumero'      => 'required|integer',
            'endcomplemento' => 'required|max:255',
            'endreferencia'  => 'required|max:255',
            'endobservacao'  => 'required|max:255',
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Request error',
                'errors'  => $this->catchErrorsFromValidator($validator)
            ], 400);
        }
        
        $data = $request->only($this->columns);
        
        $exists = Pessoa::find($data['psocodigo']);
        
        if (!$exists) {
            return response()->json([
                'message' => 'No data found <psocodigo>'
            ], 404);
        }
        
        Endereco::create(array_merge($data, [
            'endcodigo' => Endereco::max('endcodigo') + 1,
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
            'psocodigo'      => 'integer',
            'endestado'      => 'max:2',
            'endcidade'      => 'max:100',
            'endbairro'      => 'max:100',
            'endlogradouro'  => 'max:100',
            'endnumero'      => 'integer',
            'endcomplemento' => 'max:255',
            'endreferencia'  => 'max:255',
            'endobservacao'  => 'max:255',
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Request error',
                'errors'  => $this->catchErrorsFromValidator($validator)
            ], 400);
        }
        
        $model = Endereco::find($id);
        
        if (!$model) {
            return response()->json([
                'message' => 'No data found'
            ], 404);
        }
        
        $hasUpdates = $this->loadModelFromRequest($this->columns, $model, $request);
        
        if (!$hasUpdates) {
            return response()->json([
                'message' => 'No changes found'
            ], 400);
        }
        
        if (!is_null($request->input('psocodigo')) && !Pessoa::find($request->input('psocodigo'))) {
            return response()->json([
                'message' => 'Violated constraint <tbendereco_psocodigo_foreign>'
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
        $model = Endereco::find($id);
        
        if (!$model) {
            return response()->json([
                'message' => 'No data found'
            ], 404);
        }
        
        $model->delete();
        
        return response()->json(['message' => 'Removed']);
    }
    
}
