<?php

namespace Database\Factories;

use App\Models\store;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\product;
use DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\product>
 */
class productFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = product::class;
    public function definition()
    {
        $base_price = $this->faker->numberBetween(20, 6000);

        return [
            'name' => $this->faker->word(),
            'description' => $this->faker->paragraph(),
            'store_id'=> store::all()->random()->id,
            'base_price' => $base_price,
            'discount_price' => $base_price * 0.2,
            'flag' => false,
            'created_at'=> now(),
            'updated_at' => now()
        ];
    }
}
