<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Adm_feedback extends Model
{
	protected $table = "adm_feedback";
    public function user()
    {
        return $this->belongsTo('App\Wag_users', 'wag_users_id');
    }    
}
