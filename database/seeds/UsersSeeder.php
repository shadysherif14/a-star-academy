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
            'first_name' => 'Shady',
            'last_name' => 'Sherif',
            'email' => 'shady@user.com',
            'gender' => 'Male',
        ]);

        factory(App\User::class)->create([
            'username' => 'hossam',
            'first_name' => 'Hossam',
            'last_name' => 'Hossien',
            'email' => 'hossam@user.com',
            'gender' => 'Male',
        ]);

    }
}
