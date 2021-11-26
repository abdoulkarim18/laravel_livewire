<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $comments =  \App\Models\User::factory(2)->create();

        // $comments = \App\Models\Comment::factory(3)->create();

        $comments->each(function($comment){

            \App\Models\Comment::factory(2)->create([

                'user_id'=>$comment->id,
                'support_ticket_id'=>$comment->id,
            ]);
        });

    }
}
