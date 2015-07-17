<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class RolesTableSeeder extends Seeder {

    public function run()
    {
         //delete users table records
         DB::table('roles')->delete();
         //insert some dummy records
         DB::table('roles')->insert(array(
             array('role'=>'admin'),array('role'=>'editor'),array('role'=>'user')  
          ));
    }

}