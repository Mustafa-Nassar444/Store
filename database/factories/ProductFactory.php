<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Store;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
    public function definition()
    {$this->faker->locale('en');
        $name=$this->faker->words(2,true);

        return [
            //

            'name'=>$name,
            'slug'=>Str::slug($name),
            'description'=>$this->faker->sentence(10),
            'image'=>$this->faker->imageUrl(300,300),
            'price'=>$this->faker->randomFloat(1,1,499),
            'compare_price'=>$this->faker->randomFloat(1,500,999),
            'feature'=>rand(0,1),
            'category_id'=>Category::inRandomOrder()->first()->id,
            'store_id'=>Store::inRandomOrder()->first()->id,
        ];
    }
}
