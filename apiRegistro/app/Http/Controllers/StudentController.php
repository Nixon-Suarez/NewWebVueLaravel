<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Student;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    // endpoint para consultar registros
    public function select(){
        try{
            $estudiante = Student::all();
            if($estudiante->count() > 0){
                return response()->json([
                    'code' =>  200,
                    'data' =>$estudiante
                    ], 200);
            }else{
                return response()->json([
                    'code' =>  404,
                    'data' => 'No se encontraron estudiantes'
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
                'nombre' => 'required|string|max:255',
                'correo' => 'required|string|email|max:255',
                'fechaNacimiento' => 'required|date',
            ]);

            if($validator->fails()){
                return response()->json([
                    'code' => 400,
                    'data' => $validator->messages()
                ], 400);
            }

            $estudiante = Student::create([
                'name' => $request->name,
                'descripcion' => $request->descripcion
            ]);

            return response()->json([
                'code' => 201,
                'data' => 'estudiante creado exitosamente',
            ], 201);
        }catch(\Exception $e){
            return response()->json($e->getMessage(), 500);
        }
    }
    // endpoint para actualizar registros
    public function update(Request $request, $id){
        try{
            $validator = Validator::make($request->all(), [
                'nombre' => 'required|string|max:255',
                'correo' => 'required|string|email|max:255',
                'fechaNacimiento' => 'required|date',
            ]);

            if($validator->fails()){
                return response()->json([
                    'code' => 400,
                    'data' => $validator->messages()
                ], 400);
            }

            $estudiante = Student::find($id);
            if(!$estudiante){
                return response()->json([
                    'code' => 404,
                    'data' => 'estudiante no encontrado'
                ], 404);
            }

            $estudiante->update([
                'name' => $request->name,
                'descripcion' => $request->descripcion
            ]);

            return response()->json([
                'code' => 200,
                'data' => 'estudiante actualizado exitosamente',
            ], 200);
        }catch(\Exception $e){
            return response()->json($e->getMessage(), 500);
        }
    }
    // endpoint para eliminar registros
    public function delete($id){
        try{
            $estudiante = Student::find($id);
            if(!$estudiante){
                return response()->json([
                    'code' => 404,
                    'data' => 'estudiante no encontrado'
                ], 404);
            }
            $estudiante->delete($id);
            return response()->json([
                'code' => 200,
                'data' => 'estudiante eliminado exitosamente',
            ], 200);
        }catch(\Exception $e){
            return response()->json($e->getMessage(), 500);
        }
    }
    // endpoint para buscar registros
    public function find($id){
        try{
            $estudiante = Student::where("id", $id)->get();
            if($estudiante->isEmpty()){
                return response()->json([
                    'code' => 404,
                    'data' => 'estudiante no encontrado'
                ], 404);
            }
            return response()->json([
                'code' => 200,
                'data' => $estudiante[0]
            ], 200);
        }catch(\Exception $e){
            return response()->json($e->getMessage(), 500);
        }
    }
}
