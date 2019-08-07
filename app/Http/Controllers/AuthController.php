<?php

namespace App\Http\Controllers;

use App\User;
use http\Env\Response;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\JWTAuth;

class AuthController extends Controller
{
    public function login() {
        $credentials = request(['email', 'password']);

        if (!$token = auth('api')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return response()->json([
            'token' => $token,
            'type' => 'bearer',
            'expires' => auth('api')->factory()->getTTL() * 60,

        ]);
    }
    public function register(Request $request)
    {
        try {
            $user = new User();
            $user->name=$request->name;
            $user->email=$request->email;
            $user->password = bcrypt($request->password);
            $user->email_verified_at = now();
            $user->save();
            return Response(json_encode(['created' => 'true']), 201);
        }
        catch(QueryException $e){
            return Response(json_encode(['created' => 'false','msg'=>$e->getMessage()]), 400);
        }
    }
    public function logout(){
        auth('api')->logout();
        return Response(['logout'=>'true'],200);
    }
}