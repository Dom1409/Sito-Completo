<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Wish extends Model
{
    protected $table = 'wishes';
    public $timestamps = false;

    protected $fillable = ['id_user', 'title', 'image'];
}

