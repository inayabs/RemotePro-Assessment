<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    public function manufacturer(){
        return $this->belongsTo(Manufacturer::class,'manufacturer_id','id');
    }

    public function type(){
        return $this->belongsTo(Type::class,'type_id','id');
    }

    public function color(){
        return $this->belongsTo(Color::class,'color_id','id');
    }
}
