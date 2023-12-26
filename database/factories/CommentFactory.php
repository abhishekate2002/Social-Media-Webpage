<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
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
            'body' => $this->faker->sentence()
        ];
    }

    public function configure()
    {
        return $this->afterMaking(function (Comment $comment) {
            // Assign to a random post and user
            $randomPost = Post::inRandomOrder()->first();
            $randomUser = User::inRandomOrder()->first();
            $randomPost->comments()->save($comment);
            $randomUser->comments()->save($comment);
    });
    } 

}
