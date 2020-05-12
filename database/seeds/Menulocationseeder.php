<?php

use Illuminate\Database\Seeder;

class Menulocationseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menu_list =  [
           ['name' =>'header' ],
            ['name' =>'siderbar' ],
            ['name' =>'footer' ]
        ];
        DB::table('menulocation')->insert( $menu_list);
    }
}
