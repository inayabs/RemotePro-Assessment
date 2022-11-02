<?php

namespace App\Http\Controllers;

use App\Http\Resources\CarResource;
use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CarController extends Controller
{
    public function index(){
        $cars = CarResource::collection(Car::orderBy('updated_at','desc')->get());

        return $cars;
    }

    public function get($id){
        $car = new CarResource(Car::findOrFail($id));

        return $car;
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'name'              => 'required',
            'manufacturer_id'   =>'required',
            'type_id'           =>'required',
            'color_id'          =>'required'
        ]);

        if($validator->fails()){
            return response()->json(['error'=>$validator->messages()],400);
        }

        $car = new Car;
        $car->name              = $request->name;
        $car->manufacturer_id   = $request->manufacturer_id;
        $car->type_id           = $request->type_id;
        $car->color_id          = $request->color_id;

        if($car->save()){
            return response()->json(['message'=>'Car successfully added!'],201);
        }
    }

    public function update(Request $request, $id){
        $validator = Validator::make($request->all(),[
            'name'              => 'required',
            'manufacturer_id'   =>'required',
            'type_id'           =>'required',
            'color_id'          =>'required'
        ]);

        if($validator->fails()){
            return response()->json(['error'=>$validator->messages()],400);
        }
        
        $car = Car::findOrFail($id);
        $car->name              = $request->name;
        $car->manufacturer_id   = $request->manufacturer_id;
        $car->type_id           = $request->type_id;
        $car->color_id          = $request->color_id;

        if($car->update()){
            return response()->json(['message'=>'Car successfully updated!']);
        }
    }

    public function delete($id){
        $car = Car::findOrFail($id);
        
        if($car->delete()){
            return response()->json(['message'=>'Car successfully deleted!']);  
        }
    }
}
