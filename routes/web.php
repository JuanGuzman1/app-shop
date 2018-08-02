

<?php
use App\Product;
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
    $products = Product::all();
    return view('welcome')->with(compact('products'));
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/products/{id}/', 'ProductController@show'); //formulario de edicion

Route::middleware(['auth','admin'])->prefix('admin')->namespace('Admin')->group(function () {
    Route::get('/products', 'ProductController@index'); //listado
    Route::get('/products/create', 'ProductController@create'); //Formulario
    Route::post('/products', 'ProductController@store'); //Guardar-Registrar
    Route::get('/products/{id}/edit', 'ProductController@edit'); //formulario de edicion
    Route::post('/products/{id}/edit', 'ProductController@update'); //Actualizar
    Route::delete('/products/{id}', 'ProductController@destroy'); //formulario de eliminar
    //Rutas imagenes
    Route::get('/products/{id}/images', 'ImageController@index'); //listado
    Route::post('/products/{id}/images', 'ImageController@store'); //registrar
    Route::delete('/products/{id}/images', 'ImageController@destroy'); //eliminar
    Route::get('/products/{id}/images/select/{image}', 'ImageController@select'); //destacar
});

