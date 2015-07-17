<?php


use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class PermissionsTableSeeder extends Seeder {

    public function run()
    {
         //delete users table records
         DB::table('permissions')->delete();
         //insert some dummy records
         DB::table('permissions')->insert(array(
         	 array('name'=>'user_list','group'=>'User'),
             array('name'=>'view_user', 'group'=>'User'),
             array('name'=>'edit_user','group'=>'User'),
             array('name'=>'delete_user','group'=>'User'),
             array('name'=>'change_user_password','group'=>'User'),
             array('name'=>'change_password','group'=>'User'),
             array('name'=>'edit_profile','group'=>'User')
          ));
    }

}