<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index(){
        $data=Category::all();
        return response()->json([
            'code'=>200,
            'status'=>'success',
            'data'=>$data
        ]);
    }

    public function store(Request $request){
        {
            $data_input = $request->input('data', null);
            if ($data_input) {
                $data = json_decode($data_input, true);

                // Verificar si la decodificación fue exitosa
                if (json_last_error() !== JSON_ERROR_NONE) {
                    return response()->json([
                        'status' => 400,
                        'message' => 'Error en la decodificación del JSON'
                    ], 400);
                }

                $data = array_map('trim', $data);
                $rules = [
                    'nombre' => 'required|max:10'
                ];
                $isValid = \Validator::make($data, $rules);

                if ($isValid->fails()) {
                    $response = [
                        'status' => 406,
                        'message' => 'Datos erróneos',
                        'errors' => $isValid->errors()
                    ];
                } else {
                    $category = new Category();
                    $category->nombre = $data['nombre'];
                    $category->save();

                    // No cargar la relación productos en la respuesta
                    $response = [
                        'status' => 201,
                        'message' => 'Categoría creada correctamente',
                        'data' => $category
                    ];
                }
            } else {
                $response = [
                    'status' => 400,
                    'message' => 'No se encontró el objeto data'
                ];
            }

            return response()->json($response, $response['status']);
        }
    }
    public function destroy($id){
        if(isset($id) && !empty($id) && is_numeric($id)){
            $category=Category::find($id);
            if($category){
                $category->delete();
                $data=[
                    'data'=>$category,
                    'status'=>200,
                    'message'=>'Categoria eliminada correctamente'
                ];
            }else{
                $data=[
                    'data'=>null,
                    'status'=>404,
                    'message'=>'Categoria no encontrada'
                ];
            }
        }else{
            $data=[
                'data'=>null,
                'status'=>406,
                'message'=>'Datos erroneos'
            ];
        }
        return response()->json($data);
    }
}
