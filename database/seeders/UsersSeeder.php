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
            'role' => 'sales',
            'password' => bcrypt('12345678')
        ]);
    }
}
