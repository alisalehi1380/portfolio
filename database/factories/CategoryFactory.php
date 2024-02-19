<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CategoryFactory extends Factory
{
    public function definition()
    {
        $title = 'cat ' . $this->faker->jobTitle;
        return [
            Category::TITLE => $title,
            Category::SLUG => Str::slug($title)
        ];
    }
}
