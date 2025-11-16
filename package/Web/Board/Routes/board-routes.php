<?php

use Illuminate\Support\Facades\Route;
use Web\Board\Http\Controllers\BoardController;


Route::group(['namespace'=>'Web\Board\Http\Controllers',
    "middleware" => ['web', 'auth', 'verified']],function ($router){
    $router->resource('boards','BoardController');
    $router->post('/singleBoard/{id}/addTask','BoardController@singleBoardAddTask')->name('singleBoardAddTask');
    Route::post('/updateTaskOrder', [BoardController::class, 'updateTaskOrder'])->name('updateTaskOrder');

    Route::get('membersBoard/{board}',[BoardController::class,'members'])->name('membersBoard');
    Route::get('createMembersBoard/{board}',[BoardController::class,'createMemberToBoard'])
        ->name('createMemberToBoard');
    Route::post('addMembersBoard/{board}',[BoardController::class,'addMemberToBoard'])
        ->name('addMembersBoard');
    Route::delete('removeUserToBoard/{board}/{userId}',[BoardController::class,'removeMemberToBoard'])
        ->name('removeUserToBoard');

});
