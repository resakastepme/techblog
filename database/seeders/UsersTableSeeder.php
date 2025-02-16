<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 2,
                'name' => 'Resa Komara Akbari',
                'email' => 'admin@admin.com',
                'email_verified_at' => NULL,
                'password' => 'cd650bc16d26186845339038e55fe7cc',
                'remember_token' => NULL,
                'created_at' => '2025-02-12 11:16:31',
                'updated_at' => '2025-02-12 11:16:31',
            ),
            1 => 
            array (
                'id' => 3,
                'name' => 'Ethan Carter',
                'email' => 'ethan@admin.com',
                'email_verified_at' => NULL,
                'password' => 'a2687647cccd0e85461c514f341f9787',
                'remember_token' => NULL,
                'created_at' => '2025-02-15 16:39:20',
                'updated_at' => '2025-02-15 16:39:20',
            ),
            2 => 
            array (
                'id' => 4,
                'name' => 'Sophia Mitchell',
                'email' => 'sophia@admin.com',
                'email_verified_at' => NULL,
                'password' => 'f45f61624c3f626b813e251d1b0a102c',
                'remember_token' => NULL,
                'created_at' => '2025-02-15 16:39:43',
                'updated_at' => '2025-02-15 16:39:43',
            ),
            3 => 
            array (
                'id' => 5,
                'name' => 'Liam Anderson',
                'email' => 'liam@admin.com',
                'email_verified_at' => NULL,
                'password' => 'ae2bda484836b9788979a72ba2e34f5b',
                'remember_token' => NULL,
                'created_at' => '2025-02-15 16:40:00',
                'updated_at' => '2025-02-15 16:40:00',
            ),
            4 => 
            array (
                'id' => 6,
                'name' => 'Olivia Bennett',
                'email' => 'olivia@admin.com',
                'email_verified_at' => NULL,
                'password' => '93b812c8401df9b7d85805a04645b1ce',
                'remember_token' => NULL,
                'created_at' => '2025-02-15 16:40:19',
                'updated_at' => '2025-02-15 16:40:19',
            ),
            5 => 
            array (
                'id' => 7,
                'name' => 'Noah Thompson',
                'email' => 'noah@admin.com',
                'email_verified_at' => NULL,
                'password' => '27e9275b4b61aec021231224ed033b45',
                'remember_token' => NULL,
                'created_at' => '2025-02-15 16:40:42',
                'updated_at' => '2025-02-15 16:40:42',
            ),
            6 => 
            array (
                'id' => 8,
                'name' => 'Ava Richardson',
                'email' => 'ava@admin.com',
                'email_verified_at' => NULL,
                'password' => 'a37c394e84827afc9723319973f30075',
                'remember_token' => NULL,
                'created_at' => '2025-02-15 16:40:59',
                'updated_at' => '2025-02-15 16:40:59',
            ),
            7 => 
            array (
                'id' => 9,
                'name' => 'Mason Cooper',
                'email' => 'mason@admin.com',
                'email_verified_at' => NULL,
                'password' => '0958694fdf34eaf40d53a2f286299e7d',
                'remember_token' => NULL,
                'created_at' => '2025-02-15 16:41:16',
                'updated_at' => '2025-02-15 16:41:16',
            ),
            8 => 
            array (
                'id' => 10,
                'name' => 'Isabella Hughes',
                'email' => 'isabella@admin.com',
                'email_verified_at' => NULL,
                'password' => 'f2a4467ea11d0ff979b10bd4eb793912',
                'remember_token' => NULL,
                'created_at' => '2025-02-15 16:41:38',
                'updated_at' => '2025-02-15 16:41:38',
            ),
            9 => 
            array (
                'id' => 11,
                'name' => 'James Sullivan',
                'email' => 'james@admin.com',
                'email_verified_at' => NULL,
                'password' => '0432593e1e451f6f5c1fab40f82f92f6',
                'remember_token' => NULL,
                'created_at' => '2025-02-15 16:41:56',
                'updated_at' => '2025-02-15 16:41:56',
            ),
        ));
        
        
    }
}