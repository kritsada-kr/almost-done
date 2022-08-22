<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Tag;
use App\Models\OrganizationTag;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => User::inRandomOrder()->first()->id,
            'title' => fake()->realText(30),
            'description' => fake()->realText(200),
            'view_count' => fake()->numberBetween(0, 200000),
            'like_count' => fake()->numberBetween(0, 50000),
            'status'=> fake()->numberBetween(0, 1),
            'progression'=> fake()->realText(30),
            'tag_id' => fake()->numberBetween(0, 50000),
            'organization_tag_id' => fake()->numberBetween(0, 9),
        ];
    }
}
