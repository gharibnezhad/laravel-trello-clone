<?php
use Illuminate\Support\Facades\Route;



Route::group(["namespace"=>'Web\TaskList\Http\Controllers',
    "middleware"=>['web','auth','verified']],function (){
    Route::resource('taskLists','TaskListController');
});
