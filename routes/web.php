<?php

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

Route::get('/', 'Front\HomeController@index')->name('main');
Route::get('/category/{slug}', 'Front\HomeController@category')->name('category');
Route::get('/post/{slug?}', 'Front\HomeController@post')->name('post');

Auth::routes(['register' => false,'verify' => true]);

Route::group(['middleware' => ['auth','verified']], function() {
    Route::get('/admin', 'HomeController@index')->name('dashboard');
    Route::resource('admin/role','Admin\RoleController');
    Route::resource('admin/user','Admin\UserController');
    Route::resource('admin/post','Admin\PostController');
    Route::resource('admin/homePage','Admin\HomePageSectionController');
    Route::resource('admin/contact','Admin\ContactController');
    Route::resource('admin/category','Admin\CategoryController');
    Route::resource('admin/playlist','Admin\YoutubePlaylistController');
    Route::resource('admin/tag','Admin\TagController');
    Route::resource('admin/show','Admin\ShowController');
    Route::resource('admin/show-details','Admin\ShowDetailsController');
    Route::resource('admin/program','Admin\ProgramController');
    Route::resource('admin/program-details','Admin\ProgramDetailsController');
    Route::resource('admin/keyword','Admin\FocusKeywordController');
    Route::get('get-keywords','Admin\FocusKeywordController@getKeywords')->name('get-keywords');
    Route::post('new-keywords','Admin\FocusKeywordController@newKeywords')->name('new-keywords');
    //Ck Editor Image Processing
    Route::get('ckeditor', 'Admin\PostController@create');
    Route::post('ckeditor/upload', 'Admin\PostController@uploadhandler')->name('uploadhandler');
});
