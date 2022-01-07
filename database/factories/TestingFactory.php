<?php

namespace Database\Factories;

use App\Models\Testing;
use Illuminate\Database\Eloquent\Factories\Factory;

class TestingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Testing::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'test_id' => 9,
            'title' => $this->faker->name,
            'created_by' => 2,
        ];
    }
}
