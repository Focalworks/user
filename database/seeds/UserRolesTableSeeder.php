<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class UserRolesTableSeeder extends Seeder {

    public function run()
    {
         //delete users table records
         DB::table('user_roles')->delete();
         //insert some dummy records
         DB::table('user_roles')->insert(array(
             array('uid' => 1 ,'rid' => 1)  
          ));
    }

}