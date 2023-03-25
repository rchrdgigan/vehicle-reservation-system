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
                'fname'=>'FAdmin',
                'lname'=>'LAdmin',
                'email'=>'admin@example.com',
                'cpnumber'=>'09132123123',
                'address'=>'Bulan Sorsogon',
                'is_admin'=>'1',
                'password'=> bcrypt('12345678'),
            ],
            [
                'fname'=>'FUser',
                'lname'=>'LUser',
                'email'=>'user@example.com',
                'cpnumber'=>'09132123123',
                'address'=>'Bulan Sorsogon',
                'is_admin'=>'0',
                'password'=> bcrypt('12345678'),
            ],
        ];
  
        foreach ($user as $key => $value) {
            User::create($value);
        }

        $owner = [
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
