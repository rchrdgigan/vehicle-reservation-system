<?php

namespace Database\Seeders;
use App\Models\User;
use App\Models\Owner;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        $user = [
            [
                'name'=>'Admin',
                'email'=>'admin@example.com',
                'is_admin'=>'1',
                'password'=> bcrypt('12345678'),
            ],
            [
                'name'=>'User',
                'email'=>'user@example.com',
                'is_admin'=>'0',
                'password'=> bcrypt('12345678'),
            ],
        ];
  
        foreach ($user as $key => $value) {
            User::create($value);
        }

        $owner = [
            [
                'user_id'=>'1',
                'owner_fname'=>'Admin Firstname',
                'owner_lname'=>'Lastname',
                'contact'=>'09323123122',
            ],
            [
                'user_id'=>'2',
                'owner_fname'=>'User Firstname',
                'owner_lname'=>'Lastname',
                'contact'=>'09323123403',
            ],
        ];
        
        foreach ($owner as $key => $value) {
            Owner::create($value);
        }
    }
}
