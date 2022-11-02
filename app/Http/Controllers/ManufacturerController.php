<?php

namespace App\Http\Controllers;

use App\Http\Resources\ManufacturerResource;
use App\Models\Manufacturer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ManufacturerController extends Controller
{
    public function index(){
        $manufacturers = ManufacturerResource::collection(Manufacturer::all());
        
        return $manufacturers;
    }

    public function get($id){
        $manufacturer = new ManufacturerResource(Manufacturer::find($id));

        return $manufacturer;
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'name'=> 'required'
        ]);

        if($validator->fails()){
            return response()->json(['error'=>$validator->messages()],400);
        }

        $manufacturer = new Manufacturer;
        $manufacturer->name = $request->name;

        if($manufacturer->save()){
            return response()->json(['message'=>'Manufacturer successfully added!'],201);    
        }
    }

    public function update(Request $request, $id){
        $validator = Validator::make($request->all(),[
            'name'=> 'required'
        ]);

        if($validator->fails()){
            return response()->json(['error'=>$validator->messages()],400);
        }

        $manufacturer = Manufacturer::findOrFail($id);
        $manufacturer->name = $request->name;

        if($manufacturer->update()){
            return response()->json(['message'=>'Manufacturer successfully updated!']);  
        }
    }

    public function delete($id){
        $manufacturer = Manufacturer::findOrFail($id);
        if($manufacturer->delete()){
            return response()->json(['message'=>'Manufacturer successfully deleted!']);  
        }
    }
}
