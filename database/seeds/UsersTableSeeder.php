<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Juan',
            'email' => 'juanltd07@gmail.com',
            'password' => bcrypt('admin123'),
            'admin' => true

        ]);
    }
}
