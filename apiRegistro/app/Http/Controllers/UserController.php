<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function registrar(Request $request){
        try{
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string'
            ]);
            if($validator->fails()){
                return response()->json([
                    'code' => 400,
                    'data' => $validator->messages()
                ], 400);
            }else{
                $user = User::create($request->all());
                return response()->json([
                    'code' => 201,
                    'data' => $user,
                    'taken' => $user->createToken('api-key')->plainTextToken
                ], 201);
            }
        }catch(\Exception $e){
            return response()->json($e->getMessage(), 500);
        }
    }
    // inicar session
    public function login(Request $request){
        try{
            $validator = Validator::make($request->all(), [
                'email' => 'required|string|email|max:255',
                'password' => 'required|string'
            ]);
            if($validator->fails()){
                return response()->json([
                    'code' => 400,
                    'data' => $validator->messages()
                ], 400);
            }else{
                if(Auth::attempt($request->only('email', 'password'))){ // VALIDA SI EL USUARIO EXISTE Y LA CONTRASEÑA ES CORRECTA
                    $user = User::where('email', $request->email)->first();
                    return response()->json([
                        'code' => 200,
                        'data' => $user,
                        'taken' => $user->createToken('api-key')->plainTextToken
                    ], 200);
                }else{
                    return response()->json([
                        'code' => 401,
                        'data' => 'Unauthorized'
                    ], 401);
                }
            }
        }catch(\Exception $e){
            return response()->json($e->getMessage(), 500);
        }
    }
}
