<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Andito',
            'email' => 'andito763@gmail.com',
            'phone' => '085298973249',
            'firebase_token' => 'csafefefejnbe879e8f9e7gd9ff0',
            'password' => bcrypt('12345678')
        ]);
    }
}
