<?php

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

Route::get('locale/{locale}', function ($locale) {
    Session::put('locale', $locale);
    return redirect()->back();
})->name('locale');

Route::get('/api', 'Controller@index')->name('index');

Route::get('/{page?}', function ($page = 'link') {
    return view('welcome')->with('page', $page);
});