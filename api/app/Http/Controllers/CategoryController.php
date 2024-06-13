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
       $data_imput=$request->input('data',null);
       if($data_imput){
        $data=json_decode($data_imput,true);
        $data= array_map('trim',$data);
        $rules=[
            'nombre'=>'required'
        ];
        $idValid=\validator($data,$rules);
        if($idValid->fails()){
            $data=[
                'error'=>$idValid->errors(),
                'status'=> 406,
                'message'=>'Datos erroneos',
            ];
        }else{
            $category=new Category();
            $category->nombre=$data['nombre'];
            $category->save();
            $data=[
                'data'=>$category,
                'status'=>201,
                'message'=>'Categoria creada correctamente'
            ];
        }
       }
    }
}
