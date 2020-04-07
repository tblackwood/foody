<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    public function category(){
        return $this->belongsTo('App\MenuCategory', 'menu_category_id', 'id');
    }

    public function getImageAttribute($value){
        if(is_null($value)){
            return '/img/default.jpg';
        }else{
            return 'uploads/menu-items/' . $value;
        }
    }
}
