<?php


use App\Http\Controllers\PostsController;
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

 

// ---------------------- Route Fetch / Display Products -------------------------
 
Route::get('/', 'App\Http\Controllers\ProductsController@index');
Route::get('/products', 'App\Http\Controllers\ProductsController@index');



// ---------------------- Route Create new Product ----------------------------
Route::get('/products-store', 'App\Http\Controllers\ProductsController@CreateProduct');
Route::get('/products-create', 'App\Http\Controllers\ProductsController@CreateProduct');
Route::post('/products-create', 'App\Http\Controllers\ProductsController@store');



// ---------------------- Route Delete Product ----------------------------
Route::get('/products/delete/{id}', 'App\Http\Controllers\ProductsController@delete');
// Route::delete('/products/{product}', 'App\Http\Controllers\ProductsController@destroy');
