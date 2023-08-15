<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\PostsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/',[HomeController::Class , 'index']);

//categories
Route::resource('categories' , CategoriesController::class);
Route::get('categories-dt' , [CategoriesController::class , 'dataTable'])->name('categoris-dt');

//post
Route::resource('posts' , PostsController::class);
Route::get('posts-dt' , [PostsController::class , 'postDataTable'])->name('posts-dt');

// Route::get('/', function () {
//     return view('welcome');
// });
