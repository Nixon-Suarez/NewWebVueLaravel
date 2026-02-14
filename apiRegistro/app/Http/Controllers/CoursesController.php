<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Courses;

class CoursesController extends Controller {
    // endpoint para consultar registros
    public function select(){
        try{
            $curso = Courses::all();
            if($curso->count() > 0){
                return response()->json([
                    'code' =>  200,
                    'data' =>$curso
                    ], 200);
            }else{
                return response()->json([
                    'code' =>  404,
                    'data' => 'No se encontraron cursos'
                    ], 404);
            }
        }catch(\Exception $e){
            return response()->json($e->getMessage(), 500);
        }
    }
    // endpoint para insertar registros
    public function insert(Request $request){
        try{
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'descripcion' => 'required|string'
            ]);

            if($validator->fails()){
                return response()->json([
                    'code' => 400,
                    'data' => $validator->messages()
                ], 400);
            }

            $curso = Courses::create([
                'name' => $request->name,
                'descripcion' => $request->descripcion
            ]);

            return response()->json([
                'code' => 201,
                'data' => 'Curso creado exitosamente',
            ], 201);
        }catch(\Exception $e){
            return response()->json($e->getMessage(), 500);
        }
    }
    // endpoint para actualizar registros
    public function update(Request $request, $id){
        try{
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'descripcion' => 'required|string'
            ]);

            if($validator->fails()){
                return response()->json([
                    'code' => 400,
                    'data' => $validator->messages()
                ], 400);
            }

            $curso = Courses::find($id);
            if(!$curso){
                return response()->json([
                    'code' => 404,
                    'data' => 'Curso no encontrado'
                ], 404);
            }

            $curso->update([
                'name' => $request->name,
                'descripcion' => $request->descripcion
            ]);

            return response()->json([
                'code' => 200,
                'data' => 'Curso actualizado exitosamente',
            ], 200);
        }catch(\Exception $e){
            return response()->json($e->getMessage(), 500);
        }
    }
    // endpoint para eliminar registros
    public function delete($id){
        try{
            $curso = Courses::find($id);
            if(!$curso){
                return response()->json([
                    'code' => 404,
                    'data' => 'Curso no encontrado'
                ], 404);
            }
            $curso->delete($id);
            return response()->json([
                'code' => 200,
                'data' => 'Curso eliminado exitosamente',
            ], 200);
        }catch(\Exception $e){
            return response()->json($e->getMessage(), 500);
        }
    }
    // endpoint para buscar registros
    public function find($id){
        try{
            $curso = Courses::where("id", $id)->get();
            if($curso->isEmpty()){
                return response()->json([
                    'code' => 404,
                    'data' => 'Curso no encontrado'
                ], 404);
            }
            return response()->json([
                'code' => 200,
                'data' => $curso[0]
            ], 200);
        }catch(\Exception $e){
            return response()->json($e->getMessage(), 500);
        }
    }
}
