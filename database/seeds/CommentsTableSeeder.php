<?php

use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class, 30)->make()
        ->each(function (App\User $user) {
            $user->comments()->saveMany(factory(App\Comment::class, 1)->create());
        });
    }
}
