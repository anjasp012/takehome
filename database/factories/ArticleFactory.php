<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $title = $this->faker->sentence(),
            'slug' => Str::slug($title),
            'body' => $this->faker->paragraph(),
            'meta_keyword' => $this->faker->word(),
            'meta_description' => $this->faker->word(),
        ];
    }
}
