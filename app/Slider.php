<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Slider extends Model
{

    public function getImageAttribute($value){
        if(is_null($value)){
            return '/img/default.jpg';
        }else{
            return 'uploads/slider/' . $value;
        }
    }
}
