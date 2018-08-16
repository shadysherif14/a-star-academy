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
        
        $user = new App\User;
        $user->username = 'admin';
        $user->first_name = "first";
        $user->last_name = "last";
        $user->email = 'admin@admin.com';
        $user->gender = "Male";
        $user->password = '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm'; // secret
        $user->save();
    }
}
