<?php

Route::get('users/register', 'Focalworks\Users\Http\Controllers\UsersController@register');
Route::post('users/register', 'Focalworks\Users\Http\Controllers\UsersController@doRegister');
Route::get('users/forgotPassword', 'Focalworks\Users\Http\Controllers\UsersController@forgotPassword');
Route::post('users/forgotPassword', 'Focalworks\Users\Http\Controllers\UsersController@sendPasswordEmail');
Route::get('users/resetPassword/{encrypt}', 'Focalworks\Users\Http\Controllers\UsersController@resetPassword');
Route::post('users/resetPassword', 'Focalworks\Users\Http\Controllers\UsersController@saveResetPassword');
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
Route::get('admin/editRole/{id}', 'Focalworks\Users\Http\Controllers\AdminController@editRole');
Route::post('admin/saveRole', 'Focalworks\Users\Http\Controllers\AdminController@saveRole');
Route::get('admin/deleteRole/{id}', 'Focalworks\Users\Http\Controllers\AdminController@deleteRole');
Route::get('admin/addRole', 'Focalworks\Users\Http\Controllers\AdminController@addRole');

/*Routes relate to permissions*/
Route::get('admin/permissionsListing', 'Focalworks\Users\Http\Controllers\AdminController@permissionsListing');
Route::get('admin/editPermission/{id}', 'Focalworks\Users\Http\Controllers\AdminController@editPermission');
Route::get('admin/addPermission', 'Focalworks\Users\Http\Controllers\AdminController@addPermission');

Route::post('admin/editPermission', 'Focalworks\Users\Http\Controllers\AdminController@updatePermission');
Route::get('admin/deletePermission/{id}', 'Focalworks\Users\Http\Controllers\AdminController@deletePermission');
Route::post('admin/addPermission', 'Focalworks\Users\Http\Controllers\AdminController@savePermission');
