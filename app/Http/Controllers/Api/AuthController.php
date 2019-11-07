<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Traits\ParamErrorTrait;
use App\Models\Usuario;
use JWTAuth;
use Hash;

/**
 * Responsável por requisições referentes a autenticação JWT
 * 
 * @author Deivid Staehr
 */
class AuthController extends Controller {
    
    use ParamErrorTrait;
    
    public function __construct() {
        $this->middleware('jwt.auth')->except('login');
    }
    
    /**
     * Gera o token
     * 
     * @param  Request $request
     * 
     * @return array
     */
    public function login(Request $request) {
        $validator = Validator::make($request->all(), [
            'usuemail' => 'required|max:100',
            'ususenha' => 'required|max:100'
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Request error',
                'errors'  => $this->catchErrorsFromValidator($validator)
            ], 400);
        }
        
        $credentials = $request->only(['usuemail', 'ususenha']);
		
		$user = Usuario::where('usuemail' , $credentials['usuemail'])->first();
		
		if (!$user) {
            return response()->json(['message' => 'Usuário não encontrado'], 404);
        }
		
		if (!Hash::check($credentials['ususenha'], $user->ususenha)) {
            return response()->json(['message' => 'Senha inválida'], 401);
        }

        $token = JWTAuth::fromUser($user);

        return $this->respondWithToken($token);
    }

    /**
     * Retorna as informações do payload
     * 
     * @return array
     */
    public function me() {
        return response()->json($this->guard()->user());
    }
    
    /**
     * Desabilita o token
     * 
     * @return array
     */
    public function logout() {
        $this->guard()->logout();
        
        return response()->json(['message' => 'Successfully logged out']);
    }
    
    /**
     * Gera um novo token
     * 
     * @return array
     */
    public function refresh() {
        return $this->respondWithToken($this->guard()->refresh());
    }
    
    /**
     * @param  string $token
     * 
     * @return array
     */
    protected function respondWithToken($token) {
        return response()->json([
            'message'      => 'Token successfully created',
            'access_token' => $token
        ]);
    }
    
    public function guard() {
        return Auth::guard();
    }

}
