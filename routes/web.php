<?php

use App\Item;
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
    $items = Item::where('status', '=', '1')->orderBy('id', 'DESC')->get();
    return view('front-end.content.index', compact('items'));
});
//Route::resource('item', 'ItemController');
//Route::get('item', 'frontend\ItemController@index');
Route::get('item/create', 'frontend\ItemController@create');
Route::post('item', 'frontend\ItemController@store')->name('front.store.item');
Route::delete('item/{id}', 'frontend\ItemController@store');
//Route::get('item\{id}', 'frontend\ItemController@show');
//Route::get('item\{id}\edit', 'frontend\ItemController@edit');
//Route::put('item\{id}', 'frontend\ItemController@update');

//Route::get('/home', 'HomeController@index')->name('home');

Route::get('item/{id}','frontend\ItemController@show');
Route::get('profile','frontend\ProfileController@index');
Route::get('newad','frontend\ItemController@create');
Route::get('newad/create','frontend\ItemController@store')->name('front.Store.item');
Route::get('category/{id}','frontend\CategoryController@show');



Route::prefix('admin')->middleware('admin')->group(function () {

    Route::get('/', function () {
        $users = \App\User::all()->count();
        $usersNoActive = \App\User::where('regstatus','=', '0')->count();
        $items = \App\Item::all()->count();
        $comments = \App\Comment::all()->count();
        $usersLatest = \App\User::orderBy('id', 'DESC')->take(6)->get();
        $itemsLatest = \App\Item::orderBy('id', 'DESC')->take(6)->get();
        $commentsLatest = \App\Comment::orderBy('id', 'DESC')->take(6)->get();

        return view('admin.content.dashboard', compact(['users', 'usersNoActive', 'items', 'comments', 'usersLatest', 'itemsLatest','commentsLatest']));
    });
    Route::resource('category', 'backend\CategoryController');
    Route::resource('member', 'backend\UserController');
    Route::resource('item', 'backend\ItemController');
    Route::resource('comment', 'backend\CommentController');

});

Auth::routes();
