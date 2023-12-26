<?php

namespace Database\Factories;

use App\Models\Blog;
use App\Models\Post;
use App\Models\User;
use App\Models\Image;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Image>
 */
class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'path' => $this->faker->imageUrl()
        ];
    }

    protected $model = Image::class;

    public function configure()
    {
        return $this->afterMaking(function (Image $image) {
            $types = $this->faker->numberBetween(0, 2);

            if ($types == 0) {
                Post::inRandomOrder()->first()
                    ->images()->save($image);
            } else if ($types == 1) {
                User::inRandomOrder()->first()
                    ->image()->save($image);
            } else {
                Blog::inRandomOrder()->first()
                    ->image()->save($image);
            }

        });
    }
}
