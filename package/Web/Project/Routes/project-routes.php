<?php

use Illuminate\Support\Facades\Route;
use Web\Project\Http\Controllers\ProjectController;


Route::group(["namespace"=>"Web\Project\Http\Controllers",
    "middleware"=>['web','auth','verified']],function (){
    Route::resource('projects','ProjectController');
    Route::get('membersProject/{project}',[ProjectController::class,'members'])->name('membersProject');
    Route::get('createMembersProject/{project}',[ProjectController::class,'createMemberToProject'])->name('createMemberToProject');
    Route::post('addMembersProject/{project}',[ProjectController::class,'addMemberToProject'])->name('addMembersProject');
    Route::delete('removeUserToProject/{projectId}/{userId}',[ProjectController::class,'removeMemberToProject'])->name('removeUserToProject');
    Route::post('/projects/{project}/export/json',[ProjectController::class,'exportJson'])->name('projects.exportJson');
    Route::post('/projects/{project}/export/pdf',[ProjectController::class,'exportPdf'])->name('projects.exportPdf');
});
