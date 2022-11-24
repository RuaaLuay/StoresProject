<?php

namespace Database\Factories;

use App\Models\product;
use App\Models\purchaseTransaction;
use Illuminate\Database\Eloquent\Factories\Factory;
use DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class purchaseTransactionFactory extends Factory
{
    protected $model = purchaseTransaction::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $productsIDs = DB::table('products')->pluck('id');
        return [
            'product_id'=> product::factory(),
            'purchase_price' => product::all()->random()->id,
            'created_at'=> now(),
            'updated_at' => now()
        ];
    }
}
