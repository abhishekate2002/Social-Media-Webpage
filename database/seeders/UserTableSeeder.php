<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $a = new User;
        $a->id=1;
        $a->name = 'Abhishekdfbfxcvx';
        $a->email= 'abhrszvfdxvi@email.com';
        $a->password = '123456xcvv789';
        $a->save();
        
        User::factory()->count(10)->create();
    }
}
