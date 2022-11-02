<?php

namespace App\Http\Controllers;

use App\Http\Resources\ColorResource;
use App\Models\Color;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ColorController extends Controller
{
    public function index(){
        $colors = ColorResource::collection(Color::all());
        
        return $colors;
    }

    public function get($id){
        $color = new ColorResource(Color::find($id));

        return $color;
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'name'=> 'required'
        ]);

        if($validator->fails()){
            return response()->json(['error'=>$validator->messages()],400);
        }

        $color = new Color;
        $color->name = $request->name;

        if($color->save()){
            return response()->json(['message'=>'Color successfully added!'],201);    
        }
    }

    public function update(Request $request, $id){
        $validator = Validator::make($request->all(),[
            'name'=> 'required'
        ]);

        if($validator->fails()){
            return response()->json(['error'=>$validator->messages()],400);
        }
        
        $color = Color::findOrFail($id);
        $color->name = $request->name;

        if($color->update()){
            return response()->json(['message'=>'Color successfully updated!']);  
        }
    }

    public function delete($id){
        $color = Color::findOrFail($id);
        if($color->delete()){
            return response()->json(['message'=>'Color successfully deleted!']);  
        }
    }
}
