<?php

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

        factory(App\User::class)->create([
            'username' => 'shady',
            'name' => 'Shady Sherif',
            'email' => 'shady@user.com',
            'gender' => 'Male'
        ]);

        factory(App\User::class)->create([
            'username' => 'hossam',
            'name' => 'Hossam Hossien',
            'email' => 'hossam@user.com',
            'gender' => 'Male'
        ]);

    }
}
