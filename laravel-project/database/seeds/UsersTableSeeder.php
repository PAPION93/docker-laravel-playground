<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * php artisan make:seeder UsersTableSeeder
     *
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\User::truncate();
        factory('App\User', 10)->create();
    }
}
