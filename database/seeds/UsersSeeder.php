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
            'username' => 'hossam',
            'serial' => str_random(),
            'first_name' => 'Hossam',
            'last_name' => 'Hossien',
            'level_id' => '1',
            'email' => 'hossam@user.com',
            'gender' => 'Male',
        ]);

        factory(App\User::class)->create([
            'username' => 'shady',
            'serial' => str_random(),
            'first_name' => 'Shady',
            'last_name' => 'Sherif',
            'level_id' => '3',
            'email' => 'shady@user.com',
            'gender' => 'Male',
        ]);
    }
}