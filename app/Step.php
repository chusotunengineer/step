<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Step extends Model
{
    protected $fillable = ['name', 'content', 'time', 'child_num', 'image', 'user_id','category_id'];
}
