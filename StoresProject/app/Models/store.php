<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class store extends Model
{
    use SoftDeletes;
    use HasFactory;
    public function products () {
        return $this->hasMany('App\Models\product');
    }
}
