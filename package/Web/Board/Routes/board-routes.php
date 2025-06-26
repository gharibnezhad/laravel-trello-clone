<?php

use Illuminate\Support\Facades\Route;
use Web\Board\Http\Controllers\BoardController;


Route::group(['namespace'=>'Web\Board\Http\Controllers'],function ($router){
    $router->resource('boards','BoardController');
    $router->post('/singleBoard/{id}/addTask','BoardController@singleBoardAddTask')->name('singleBoardAddTask');
    Route::post('/updateTaskOrder', [BoardController::class, 'updateTaskOrder'])->name('updateTaskOrder');

});
