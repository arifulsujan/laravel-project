<?php

use App\Http\Controllers\BlogController;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::resource('/blogs', BlogController::class)->middleware('auth');

//soft Delete 

Route::get('blogs/restor/{id}',[BlogController::class,'restor'])->name('blogs.restor');

Route::get('blogs/pdestroy/{id}',[BlogController::class,'pdestroy'])->name('blogs.pdestroy');


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');



Route::group(['prefix'=>'admin'],function()
{
    
}


);