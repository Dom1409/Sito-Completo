<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Wish extends Model
{
    public $timestamps = false;

        
    public function user(){

        return $this->belongsTo('App\Model\User');


    }
}
