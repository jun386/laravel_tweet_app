<?php

use Illuminate\Database\Seeder;

class FavoritesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        for ($i = 2; $i <= 10; $i++) {
            App\Like::create([
                'user_id' => 1,
                'post_id' => $i
            ]);
        }
    }
}
