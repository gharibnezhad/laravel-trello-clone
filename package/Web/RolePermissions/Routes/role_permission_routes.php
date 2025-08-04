<?php
use Illuminate\Support\Facades\Route;

Route::group(["namespace" => "Web\RolePermissions\Http\Controllers",
              "middleware" => ['web','auth']],function (){
   Route::resource('role-permissions','RolePermissionController')->except(['show']);

});
