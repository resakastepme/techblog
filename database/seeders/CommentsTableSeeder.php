<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('comments')->delete();
        
        \DB::table('comments')->insert(array (
            0 => 
            array (
                'id' => 16,
                'post_id' => 58,
                'user_id' => 2,
                'content' => 'oka oka',
                'parent_id' => NULL,
                'created_at' => '2025-02-16 17:00:16',
                'updated_at' => '2025-02-16 17:00:16',
            ),
            1 => 
            array (
                'id' => 17,
                'post_id' => 58,
                'user_id' => 2,
                'content' => 'okay',
                'parent_id' => 16,
                'created_at' => '2025-02-16 17:04:34',
                'updated_at' => '2025-02-16 17:04:34',
            ),
        ));
        
        
    }
}