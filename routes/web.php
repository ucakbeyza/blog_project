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

//When the same URL is used in multiple Blade files, all of them must be updated if the link changes. To avoid this, it2s common to assign names to routes.

Route::view('/','home')->name(name:'home');
Route::view('/about','about')->name(name: 'about');
Route::view('/contact','contact')->name(name:'contact');
Route::view('article', 'article')->name('article');
Route::view('/second','second');