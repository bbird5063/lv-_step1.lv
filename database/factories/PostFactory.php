<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category; // добавил

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
    public function definition(): array
    {
        return [
             'title' => $this->faker->sentence(5), // не обязательно title, можно name,sentence, word; там куча вариантов, title(х) @param mixed $gender. VSC подскажет. sentence(5)-5 слов.
             'content' => $this->faker->text,
						 'image' => $this->faker->imageUrl(),
						 'likes' => random_int(1, 200),
						 'is_published' => 1,
						 'category_id' => Category::get()->random()->id,	
			];
    }
}
