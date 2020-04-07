<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MenuCategory extends Model
{
    public function getImageAttribute($value){
        if(is_null($value)){
            return '/img/default.jpg';
        }else{
            return 'uploads/menu-category/' . $value;
        }
    }

    public function menus(){
        return $this->hasMany('App\Menu','menu_category_id', 'id');
    }
}
