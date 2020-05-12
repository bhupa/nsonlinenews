<?php

use Illuminate\Database\Seeder;
use App\Model\User_type\User_type;

class User_TypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       User_type::Create([
            'user_type'=>'Admin'
        ]);
        User_type::Create([
            'user_type'=>'Editor'
        ]);
        User_type::Create([
            'user_type'=>'User'
        ]);
    }
}
