<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $a = new Post;
        $a->id = 1;
        $a->title= 'This is title';
        $a->body = 'acsa wfjds weasDHc casdzc xcz dd sb w bfsidzjbck';
        $a->save();
        
        //
        Post::factory()->count(10)->create();
    }
}
