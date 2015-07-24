<?php

Route::get('users/register', 'Focalworks\Users\Http\Controllers\UsersController@register');
Route::post('users/register', 'Focalworks\Users\Http\Controllers\UsersController@doRegister');
Route::get('users/login', 'Focalworks\Users\Http\Controllers\UsersController@login');
Route::post('users/login', 'Focalworks\Users\Http\Controllers\UsersController@doLogin');
Route::get('users/dashboard', 'Focalworks\Users\Http\Controllers\UsersController@dashboard');
Route::get('users/myprofile', 'Focalworks\Users\Http\Controllers\UsersController@myprofile');
Route::get('users/changePassword', 'Focalworks\Users\Http\Controllers\UsersController@changePassword');
Route::post('users/saveNewPassword', 'Focalworks\Users\Http\Controllers\UsersController@saveNewPassword');
Route::get('users/editProfile', 'Focalworks\Users\Http\Controllers\UsersController@editProfile');
Route::post('users/saveUserProfile', 'Focalworks\Users\Http\Controllers\UsersController@saveUserProfile');
Route::get('users/logout', 'Focalworks\Users\Http\Controllers\UsersController@logout');
Route::get('users/access_denied', 'Focalworks\Users\Http\Controllers\UsersController@access_denied');

Route::get('admin/userListing', 'Focalworks\Users\Http\Controllers\AdminController@user_listing');
Route::get('admin/editUser/{id}', 'Focalworks\Users\Http\Controllers\AdminController@editUser');
Route::get('admin/changeUserPassword/{id}', 'Focalworks\Users\Http\Controllers\AdminController@changeUserPassword');
Route::get('admin/deleteUser/{id}', 'Focalworks\Users\Http\Controllers\AdminController@deleteUser');
Route::post('admin/saveUserProfile', 'Focalworks\Users\Http\Controllers\AdminController@saveUserProfile');
Route::post('admin/saveUserPassword', 'Focalworks\Users\Http\Controllers\AdminController@saveUserPassword');
Route::get('admin/permissionMatrix', 'Focalworks\Users\Http\Controllers\AdminController@getPermissionMatrix');
Route::post('admin/permissionMatrix', 'Focalworks\Users\Http\Controllers\AdminController@savePermissionMatrix');
Route::get('admin/roleListing', 'Focalworks\Users\Http\Controllers\AdminController@role_listing');