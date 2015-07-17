<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class UsersTableSeeder extends Seeder {

    public function run()
    {
         //delete users table records
         DB::table('users')->delete();
         //insert some dummy records
         DB::table('users')->insert(array(
             array('name'=>'admin','email'=>'admin@admin.com','password'=>Hash::make('123456')),  
          ));
    }

}