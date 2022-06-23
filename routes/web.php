<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoListController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('todolist');
});


Route::get('/laravel', function () {
    return view('laravel');
});


Route::resource('/tasks', TodoListController::class);
Route::get('/todolist', TodoListController::class . '@index');
Route::post('/todolist', TodoListController::class . '@store');
Route::put('/todolist/{id}', TodoListController::class . '@update');
Route::delete('/todolist/{id}', TodoListController::class . '@destroy');


//Route::resource('todolist', TodoListController::class);
/*
Route::get('/queries', function(){
    $events = \App\Models\Event::all();

    return $events;
});

Route::get('/hello-world', function(){
    return view('hello-world');
});

Route::get('/hello/{name?}', function($name = 'Fulano'){
    return 'Hello, ' . $name;
});
*/

/*Route::get('/queries', function(){
    $events = \App\Models\Event::all();

    return $events;
})*/

//Route::get('/hello-world', [\App\Http\Controllers\HelloWorldController::class, 'helloWorld']);

//Route::get('/hello/{name?}', [\App\Http\Controllers\HelloWorldController::class, 'hello']);


