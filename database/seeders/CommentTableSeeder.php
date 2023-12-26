<?php

namespace Database\Seeders;

use App\Models\Comment;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CommentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $a = new Comment;
        $a->id = 1;
        $a->body = 'Title ';
        $a->save();
        
        Comment::factory()->count(20)->create();
    }
}
