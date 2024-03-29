<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $name=$this->faker->words(2,true);
        return [
            //
            'parent_id'=>rand(1,5),
            'name'=>$name,
            'slug'=>Str::slug($name),
            'description'=>$this->faker->sentence(10),
            'image'=>$this->faker->imageUrl(300,300),
        ];
    }
}
