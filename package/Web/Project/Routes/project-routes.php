<?php

use Illuminate\Support\Facades\Route;
use Web\Project\Http\Controllers\ProjectController;


Route::group(["namespace"=>"Web\Project\Http\Controllers",
    "middleware"=>['web','auth','verified']],function (){
    Route::resource('projects','ProjectController');
    Route::get('addMembersProject',[ProjectController::class,'addMember'])->name('addMembersProject');
});
