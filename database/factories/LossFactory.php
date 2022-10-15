<?php

namespace Database\Factories;

use App\Models\Loss;
use Illuminate\Database\Eloquent\Factories\Factory;

class LossFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Loss::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'recipe_id' => $this->faker->randomDigitNotNull,
        'qty' => $this->faker->word,
        'cost' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
