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
            'serial' => 'kjnlakdhfbljkSADASDF',
            'first_name' => 'Hossam',
            'last_name' => 'Hossien',
            'level_id' => '1',
            'email' => 'hossam@user.com',
            'gender' => 'Male',
        ]);
    }
}