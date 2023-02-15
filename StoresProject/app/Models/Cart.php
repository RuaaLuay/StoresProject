<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cart extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $table = 'carts';
    protected $fillable = [
        'customer_id',
        'product_id',
        'product_quantity'
    ];
    public function product () {
        return $this->belongsTo('App\Models\Product');
    }
}
