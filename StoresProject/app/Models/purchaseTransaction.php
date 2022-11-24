<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class purchaseTransaction extends Model
{
    protected $table = 'purchase_transactions';
    use SoftDeletes;
    use HasFactory;
    public function product () {
        return $this->belongsTo(product::class,'product_id');
    }
}
