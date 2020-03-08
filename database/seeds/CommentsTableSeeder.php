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
        //
        for ($i = 1; $i <= 10; $i++) {
            App\Comment::create([
                'user_id' => 1,
                'post_id' => $i,
                'content' => 'これはテストコメント' .$i,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
