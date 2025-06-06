<?php

use Illuminate\Support\Facades\Route;
use Web\Project\Http\Controllers\ProjectController;


Route::group(["namespace"=>"Web\Project\Http\Controllers",
    "middleware"=>['web','auth','verified']],function (){
    Route::resource('projects','ProjectController');
    Route::get('addMembersProject/{project}',[ProjectController::class,'addMember'])->name('addMembersProject');
    Route::post('/projects/{project}/export/json',[ProjectController::class,'exportJson'])->name('projects.exportJson');
    Route::post('/projects/{project}/export/pdf',[ProjectController::class,'exportPdf'])->name('projects.exportPdf');
});
