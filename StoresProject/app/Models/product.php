<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class product extends Model
{
    use SoftDeletes;
    use HasFactory;
    public function store () {
        return $this->belongsTo(store::class,'store_id');
    }
    public function purchase_transactions () {
        return $this->hasMany(purchaseTransaction::class);
    }
}
