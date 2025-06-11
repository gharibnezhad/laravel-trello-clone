<?php
use Illuminate\Support\Facades\Route;
use Web\TaskList\Http\Controllers\TaskListController;


Route::group(["namespace"=>'Web\TaskList\Http\Controllers',
    "middleware"=>['web','auth','verified']],function (){
    Route::resource('taskLists','TaskListController');


});
