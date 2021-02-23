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

// Route::get('/', function () {
//     return view('login');
// });

Route::get('/', 'otentikasi\LoginController@index')->name('login');
Route::post('/prosses', 'otentikasi\LoginController@login')->name('prosses');

Route::group(['middleware' => 'SessionCek'], function(){
        Route::group(['middleware' => 'AdminCek'], function(){
            // ROUTE ADMIN
            Route::get('/admin', 'AdminController@index')->name('admin');
            Route::get('/adminData', 'AdminController@dataTable')->name('adminData');
            Route::post('/adminAdd', 'AdminController@add')->name('adminAdd');
            Route::post('/delete', 'AdminController@del')->name('delete');
            
            // ROUTE JABATAN
            Route::get('/jabatan', 'JabatanController@index')->name('jabatan');
            Route::get('/jabatanData', 'JabatanController@dataTable')->name('jabatanData');
            Route::post('/jabatanAdd', 'JabatanController@create')->name('jabatanAdd');
            Route::post('/jabatanDel', 'JabatanController@destroy')->name('jabatanDel');
            Route::get('/jabatanedit/{id}', 'JabatanController@edit')->name('jabatanedit');
            Route::get('/selectJabatan', 'JabatanController@select')->name('selectJabatan');

        });
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
    Route::get('/logout', 'otentikasi\LoginController@logout')->name('logout');
});