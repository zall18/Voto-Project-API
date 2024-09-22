<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $images = ['samsungnx500-removebg-preview.png', 'pentaxk1-removebg-preview(1).png', 'nikond7500-removebg-preview.png', 'lumixgh5-removebg-preview.png', 'leicam10r-removebg-preview.png', 'fujifilmxt4-removebg-preview.png', 'fujifilmxt3-removebg-preview.png', 'fujifilmxa5-removebg-preview.png', 'canonpowershotg7x-removebg-preview.png', 'canoneosr5-removebg-preview.png', 'pentaxk1-removebg-preview.png'];
        return [
            'name' => $this->faker->word,
            'description' => $this->faker->sentence,
            'price' => $this->faker->randomFloat(2, 100, 1000),
            'stock' => $this->faker->numberBetween(10, 100),
            'brand' => $this->faker->company,
            'model' => $this->faker->word,
            'image' => $this->faker->randomElement($images),
            'is_publish' => $this->faker->boolean(),
            'is_discount' => false,
            'category_id' => Category::factory(),
            'user_id' => User::factory(),
        ];
    }
}
