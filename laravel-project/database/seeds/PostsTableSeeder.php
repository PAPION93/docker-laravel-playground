<?php

use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * php artisan make:seeder PostsTableSeeder
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Post::truncate();
        factory('App\Post', 20)->create();
    }
}
