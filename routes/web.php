<?php

use Illuminate\Support\Facades\Route;
//This structure is generally preferred if dynamic operations are to be performed.
/* 

Route::get('/', function () {
    return view('welcome');
});
Route::get('/second', function(){
    return view('second');
});
*/
//If only a view is to be returned, you do not need to define a function.
Route::view('/','home');
Route::view('/about','about');
Route::view('/contact','contact');
Route::view('/second','second');