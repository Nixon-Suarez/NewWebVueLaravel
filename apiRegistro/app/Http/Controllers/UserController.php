<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

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
                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => bcrypt($request->password)
                ]);
                return response()->json([
                    'code' => 201,
                    'data' => 'Usuario registrado exitosamente',
                ], 201);
            }
        }catch(\Exception $e){
            return response()->json($e->getMessage(), 500);
        }
    }
}
