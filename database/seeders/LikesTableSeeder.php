<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class LikesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('likes')->delete();
        
        \DB::table('likes')->insert(array (
            0 => 
            array (
                'id' => 5,
                'user_id' => 7,
                'post_id' => 58,
                'created_at' => '2025-02-16 16:50:39',
                'updated_at' => '2025-02-16 16:50:39',
            ),
            1 => 
            array (
                'id' => 6,
                'user_id' => 2,
                'post_id' => 58,
                'created_at' => '2025-02-16 17:00:05',
                'updated_at' => '2025-02-16 17:00:05',
            ),
            2 => 
            array (
                'id' => 7,
                'user_id' => 2,
                'post_id' => 57,
                'created_at' => '2025-02-16 18:23:54',
                'updated_at' => '2025-02-16 18:23:54',
            ),
        ));
        
        
    }
}