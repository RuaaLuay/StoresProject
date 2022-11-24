<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\store;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\store>
 */
class storeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = store::class;
    public function definition()
    {
        return [
            'name' => $this->faker->name . '\'s store',
            'address' => $this->faker->address,
            'Logo_path'=> 'shop_' . $this->faker->numberBetween(1, 11) . '.jpg',
            'created_at'=> now(),
            'updated_at' => now()
        ];
    }

}
