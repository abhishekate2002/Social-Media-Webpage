<?php

namespace Database\Seeders;

use App\Models\Image;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ImageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $a = new Image;
        $a->id =1;
        $a->path = 'C:\Users\abhikate06\Downloads\gnupg-2.4.0';
        $a->imageable_id = 123;
        $a->imageable_type= '.jpg';
        $a->save();
        Image::factory()->count(30)->create();
    }
}
