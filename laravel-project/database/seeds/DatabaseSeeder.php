<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        /*
         * Prepare seeding
         */
        $faker = Faker::create();
        // DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Model::unguard();

        /*
         * Seeding users table
         */
        App\User::truncate();
        factory(App\User::class)->create([
            'name' => 'sj',
            'email' => 'sjun93@naver.com',
            'password' => bcrypt('1q2w3e!!')
        ]);
        factory(App\User::class, 9)->create();
        $this->command->info('users table seeded');

        /**
         * Seeding articles table
         */
        App\Article::truncate();
        $users = App\User::all();

        $users->each(function ($user) use ($faker) {
            $user->articles()->save(
                factory(App\Article::class)->make()
            );
        });
        $this->command->info('articles table seeded');

        /**
         * Seeding comments table
         */
        App\Comment::truncate();
        $articles = App\Article::all();

        $articles->each(function ($article) use ($faker, $users) {
            $article->comments()->save(
                factory(App\Comment::class)->make([
                    'author_id' => $faker->randomElement($users->pluck('id')->toArray())
                ])
            );
        });
        $this->command->info('comments table seeded');

        /**
         * Seeding tags table
         */
        App\Tag::truncate();
        DB::table('article_tag')->truncate();
        $articles->each(function ($article) use ($faker) {
            $article->tags()->save(
                factory(App\Tag::class)->make()
            );
        });
        $this->command->info('tags table seeded');

        /**
         * Seeding attachments table
         */
        App\Attachment::truncate();
        if (!File::isDirectory(attachment_path())) {
            File::deleteDirectory(attachment_path(), true);
        }

        $articles->each(function ($article) use ($faker) {
            $article->attachments()->save(
                factory(App\Attachment::class)->make()
            );
        });

        $files = App\Attachment::pluck('name');

        if (!File::isDirectory(attachment_path())) {
            File::makeDirectory(attachment_path(), 777, true);
        }

        foreach ($files as $file) {
            File::put(attachment_path($file), '');
        }

        $this->command->info('attachments table seeded');

        /**
         * Close seeding
         */
        Model::reguard();
        // DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
