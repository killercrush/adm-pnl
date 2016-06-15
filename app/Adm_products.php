<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Adm_products extends Model
{
    public function games()
    {
        return $this->hasMany('App\Wag_games');
    }
    public function category()
    {
        return $this->belongsTo('App\Adm_category', 'category_id');
    }    
}
