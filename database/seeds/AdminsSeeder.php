<?php

use Illuminate\Database\Seeder;

class AdminsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        factory(App\Admin::class)->create([
            'username' => 'admin',
            'name' => 'Super Admin',
            'email' => 'admin@admin.com',
        ]);
    }
}
