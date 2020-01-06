<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChildStep extends Model
{
    protected $fillable = ['name', 'content', 'parent_id', 'user_id', 'order'];
}
