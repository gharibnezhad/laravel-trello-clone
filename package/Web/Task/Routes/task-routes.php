<?php

use Illuminate\Support\Facades\Route;
use Web\Task\Http\Controllers\TaskController;

Route::group(["namespace" => "Web\Task\Http\Controllers",
    "middleware" => ['web', 'auth', 'verified']], function () {

    Route::resource('tasks', 'TaskController');
    Route::get('/taskLists/by-board/{board}', [TaskController::class, 'getTaskListsForBoard']);


    Route::get('membersTask/{task}',[TaskController::class,'members'])->name('membersTask');
    Route::get('createMembersTask/{task}',[TaskController::class,'createMemberToTask'])
        ->name('createMemberToTask');
    Route::post('addMembersTask/{task}',[TaskController::class,'addMemberToTask'])
        ->name('addMembersTask');
    Route::delete('removeUserToTask/{task}/{userId}',[TaskController::class,'removeMemberToTask'])
        ->name('removeUserToTask');


});
