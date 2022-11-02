<?php

namespace App\Http\Controllers;

use App\Http\Resources\TypeResource;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TypeController extends Controller
{
    public function index(){
        $types = TypeResource::collection(Type::all());
        
        return $types;
    }

    public function get($id){
        $type = new TypeResource(Type::find($id));

        return $type;
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'name'=> 'required'
        ]);

        if($validator->fails()){
            return response()->json(['error'=>$validator->messages()],400);
        }
        $type = new Type;
        $type->name = $request->name;

        if($type->save()){
            return response()->json(['message'=>'Car type successfully added!'],201);    
        }
    }

    public function update(Request $request, $id){
        $validator = Validator::make($request->all(),[
            'name'=> 'required'
        ]);

        if($validator->fails()){
            return response()->json(['error'=>$validator->messages()],400);
        }
        
        $type = Type::findOrFail($id);
        $type->name = $request->name;

        if($type->update()){
            return response()->json(['message'=>'Car type successfully updated!']);  
        }
    }

    public function delete($id){
        $type = Type::findOrFail($id);
        if($type->delete()){
            return response()->json(['message'=>'Car type successfully deleted!']);  
        }
    }
}
