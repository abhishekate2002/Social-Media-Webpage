<?php

namespace Database\Seeders;

use App\Models\Blog;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BlogTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $a = new Blog;
        $a->id = 123;
        $a->about = 'This is about';
        $a->save();
        Blog::factory()->count(10)->create();
    }
}
