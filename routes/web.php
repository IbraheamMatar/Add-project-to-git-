<?php
use App\Mail\TestEmail;
use Illuminate\Auth\Middleware\EnsureEmailIsVerified;
use Illuminate\Support\Facades\Auth;
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


 Auth::routes();
Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home') ;


    //route for posts
    Route::get('/stores','StoreController@index')->name('stores');
    Route::get('/store/trashed','StoreController@trashed')->name('store.trashed');
    Route::get('/store/hdelete/{id}','StoreController@hdelete')->name('store.hdelete');
    Route::get('/store/restore/{id}', 'StoreController@restore')->name('store.restore');
    Route::get('/store/edit/{id}', 'StoreController@edit')->name('store.edit');
    Route::post('/store/update/{id}', 'StoreController@update')->name('store.update');

    Route::get('/post/create', 'StoreController@create')->name('post.create');

    Route::post('/post/store', 'StoreController@store')->name('post.store');
    Route::get('/store/delete/{id}', 'StoreController@destroy')->name('store.delete');



     //route for Categories
    Route::get('/categories', 'CategoriesController@index')->name('categories');
    Route::get('/category/edit/{id}', 'CategoriesController@edit')->name('category.edit');
    Route::get('/category/delete/{id}', 'CategoriesController@destroy')->name('category.delete');
    Route::get('/category/create', 'CategoriesController@create')->name('category.create');
    Route::post('/category/store', 'CategoriesController@store')->name('category.store');
    Route::post('/category/update/{id}', 'CategoriesController@update')->name('category.update');






                 //route for User front end
        Route::get('/', 'siteUIcontroller@index')->name('index');
        Route::get('/category/{id}', 'siteUIcontroller@category')->name('category.show');

         //route for showing single post
         Route::get('/post/{slug}', 'siteUIcontroller@showPost')->name('post.show');



      //route for query results
        Route::get('/results', function () {
            $post = App\Store::where('title', 'like' ,  '%' . request('search') . '%' )->get();
            return view('results.results')
            ->with('posts' , $post)
            ->with('title' ,  'Result : '. request('search') )
            ->with('categories' , App\Category::take(3)->get() )
            ->with('query' , request('search') )   ;

        }) ;

