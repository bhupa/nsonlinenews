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

Route::get('/','HomeController@index')->name('home');

Route::get('/forget_password/', array('as' =>'forget_password','uses' => 'Auth\ForgotPasswordController@resetpassword' ));
Route::post('password/email/', array('as' =>'password.email','uses' => 'Auth\ForgotPasswordController@password' ));
Route::get('/password_reset/{id}', array('as' =>'password_reset','uses' => 'Auth\ForgotPasswordController@passwordlink' ));

Route::post('/password/update', array('as' =>'password.update','uses' => 'Auth\ForgotPasswordController@updatepassword' ));


Route::get('login', array('as'=>'login','uses'=>'Auth\LoginController@index'));
Route::get('register', array('as'=>'register','uses'=>'Auth\RegisterController@index'));
Route::post('user/add', array('as'=>'user.add','uses'=>'Auth\RegisterController@create'));
Route::post('login', array('as'=>'login','uses'=>'Auth\LoginController@login'));
Route::get('logout', array('as'=>'logout','uses'=>'Auth\LoginController@logout'));


Route::get('/home', 'HomeController@index')->name('home');


Route::group(['prefix'=>'admin','middleware' => ['auth', 'admin']], function () {

    Route::get('/dashboard', function () {
        return view('backend.app');

    })->name('admin.dashboard');
    Route::get('user/index', array('as' => 'user.index', 'uses' => 'UserController@index'));
    Route::get('user/add', array('as' => 'user.add', 'uses' => 'UserController@create'));
    Route::post('user/store', array('as' => 'user.store', 'uses' => 'UserController@store'));
    Route::get('user/edit/{id}', array('as' => 'user.edit', 'uses' => 'UserController@edit'));
    Route::get('user/update/{id}', array('as' => 'user.update', 'uses' => 'UserController@update'));
    Route::post('change-status', array('as' => 'user.change-status', 'uses' => 'UserController@change_status'));
    Route::post('delete', array('as' => 'user.delete', 'uses' => 'UserController@destroy'));
    Route::get('user/assignrole/{id}', array('as' => 'user.assignrole', 'uses' => 'UserController@asignrole'));
    Route::post('user/storerole/{id}', array('as' => 'user.storerole', 'uses' => 'UserController@storerole'));
    Route::post('user/delete-role/', array('as' => 'user.delete-role', 'uses' => 'UserController@deleterole'));
    Route::get('user/assign/category/{id}', array('as' => 'user.assign.category', 'uses' => 'UserController@assigncategory'));
    Route::post('user/storer/category/{id}', array('as' => 'user.storer.category', 'uses' => 'UserController@storecategory'));
    Route::post('user/category/delete', array('as' => 'user.category.delete', 'uses' => 'UserController@deletecategory'));
    Route::group(['prefix' => 'permission'], function () {
        Route::get('/', array('as' => 'permission.index', 'uses' => 'PermissionController@index'));
        Route::get('add', array('as' => 'permission.add', 'uses' => 'PermissionController@create'));
        Route::post('store', array('as' => 'permission.store', 'uses' => 'PermissionController@store'));
        Route::get('edit/{id}', array('as' => 'permission.edit', 'uses' => 'PermissionController@edit'));
        Route::post('update/{id}', array('as' => 'permission.update', 'uses' => 'PermissionController@update'));
        Route::post('delete', array('as' => 'permission.delete', 'uses' => 'PermissionController@destroy'));
    });

    Route::group(['prefix' => 'role'], function () {
        Route::get('/', array('as' => 'role.index', 'uses' => 'RoleController@index'));
        Route::get('add', array('as' => 'role.add', 'uses' => 'RoleController@create'));
        Route::post('store', array('as' => 'role.store', 'uses' => 'RoleController@store'));
        Route::get('edit/{id}', array('as' => 'role.edit', 'uses' => 'RoleController@edit'));
        Route::post('update/{id}', array('as' => 'role.update', 'uses' => 'RoleController@update'));
        Route::post('delete', array('as' => 'role.delete', 'uses' => 'RoleController@destroy'));

    });
    Route::group(['prefix' => 'category'], function () {
        Route::get('/', array('as' => 'category.index', 'uses' => 'CategoryController@index'));
        Route::get('add', array('as' => 'category.add', 'uses' => 'CategoryController@create'));
        Route::post('store', array('as' => 'category.store', 'uses' => 'CategoryController@store'));
        Route::get('edit/{id}', array('as' => 'category.edit', 'uses' => 'CategoryController@edit'));
        Route::post('update/{id}', array('as' => 'category.update', 'uses' => 'CategoryController@update'));
        Route::post('delete', array('as' => 'category.delete', 'uses' => 'CategoryController@destroy'));
        Route::post('change-status', array('as' => 'category.change-status', 'uses' => 'CategoryController@change_status'));
        Route::post('sortable', array('as' => 'category.sortable', 'uses' => 'CategoryController@sortable'));
    });
    Route::group(['prefix' => 'sub_category'], function () {
        Route::get('/', array('as' => 'sub_category.index', 'uses' => 'SubCategoryController@index'));
        Route::get('add', array('as' => 'sub_category.add', 'uses' => 'SubCategoryController@create'));
        Route::post('store', array('as' => 'sub_category.store', 'uses' => 'SubCategoryController@store'));
        Route::get('edit/{id}', array('as' => 'sub_category.edit', 'uses' => 'SubCategoryController@edit'));
        Route::post('update/{id}', array('as' => 'sub_category.update', 'uses' => 'SubCategoryController@update'));
        Route::post('delete', array('as' => 'sub_category.delete', 'uses' => 'SubCategoryController@destroy'));
    });
    Route::group(['prefix' => 'ne_ws'], function () {
        Route::get('/', array('as' => 'ne_ws.index', 'uses' => 'NewsController@index'));
        Route::get('add', array('as' => 'ne_ws.add', 'uses' => 'NewsController@create'));
        Route::post('store', array('as' => 'ne_ws.store', 'uses' => 'NewsController@store'));
        Route::get('edit/{id}', array('as' => 'ne_ws.edit', 'uses' => 'NewsController@edit'));
        Route::post('update/{id}', array('as' => 'ne_ws.update', 'uses' => 'NewsController@update'));
        Route::post('delete', array('as' => 'ne_ws.delete', 'uses' => 'NewsController@destroy'));
        Route::post('change-status', array('as' => 'ne_ws.change-status', 'uses' => 'NewsController@change_status'));

        Route::get('subcategories', array('as' => 'news.subcategories', 'uses' => 'NewsController@getSubcategories'));
    });
    Route::group(['prefix' => 'gallery'], function () {
        Route::get('/', array('as' => 'gallery.index', 'uses' => 'GalleryController@index'));
        Route::get('add', array('as' => 'gallery.add', 'uses' => 'GalleryController@create'));
        Route::post('store', array('as' => 'gallery.store', 'uses' => 'GalleryController@store'));
        Route::get('edit/{id}', array('as' => 'gallery.edit', 'uses' => 'GalleryController@edit'));
        Route::post('update/{id}', array('as' => 'gallery.update', 'uses' => 'GalleryController@update'));
        Route::post('delete', array('as' => 'gallery.delete', 'uses' => 'GalleryController@destroy'));
        Route::post('change-status', array('as' => 'gallery.change-status', 'uses' => 'GalleryController@change_status'));

    });
    Route::group(['prefix' => 'media'], function () {
        Route::get('/{id}', array('as' => 'media.index', 'uses' => 'MediaController@index'));
        Route::get('add/{id}', array('as' => 'media.add', 'uses' => 'MediaController@create'));
        Route::post('store/{id}', array('as' => 'media.store', 'uses' => 'MediaController@store'));
        Route::get('edit/{id}', array('as' => 'media.edit', 'uses' => 'MediaController@edit'));
        Route::post('update/{id}', array('as' => 'media.update', 'uses' => 'MediaController@update'));
        Route::post('delete', array('as' => 'media.delete', 'uses' => 'MediaController@destroy'));
        Route::post('change-status', array('as' => 'media.change-status', 'uses' => 'MediaController@change_status'));

    });
    Route::group(['prefix' => 'videos'], function () {
        Route::get('/', array('as' => 'videos.index', 'uses' => 'VideoController@index'));
        Route::get('add', array('as' => 'videos.add', 'uses' => 'VideoController@create'));
        Route::post('store', array('as' => 'videos.store', 'uses' => 'VideoController@store'));
        Route::get('edit/{id}', array('as' => 'videos.edit', 'uses' => 'VideoController@edit'));
        Route::post('update/{id}', array('as' => 'videos.update', 'uses' => 'VideoController@update'));
        Route::post('delete', array('as' => 'videos.delete', 'uses' => 'VideoController@destroy'));
        Route::post('change-status', array('as' => 'videos.change-status', 'uses' => 'VideoController@change_status'));

    });
    Route::group(['prefix' => 'advertise'], function () {
        Route::get('/', array('as' => 'advertise.index', 'uses' => 'AdvertiseController@index'));
        Route::get('add', array('as' => 'advertise.add', 'uses' => 'AdvertiseController@create'));
        Route::post('store', array('as' => 'advertise.store', 'uses' => 'AdvertiseController@store'));
        Route::get('edit/{id}', array('as' => 'advertise.edit', 'uses' => 'AdvertiseController@edit'));
        Route::post('update/{id}', array('as' => 'advertise.update', 'uses' => 'AdvertiseController@update'));
        Route::post('delete', array('as' => 'advertise.delete', 'uses' => 'AdvertiseController@destroy'));
        Route::post('change-status', array('as' => 'advertise.change-status', 'uses' => 'AdvertiseController@change_status'));

    });
    Route::group(['prefix' => 'popup'], function () {
        Route::get('/', array('as' => 'popup.index', 'uses' => 'PopupController@index'));
        Route::get('add', array('as' => 'popup.add', 'uses' => 'PopupController@create'));
        Route::post('store', array('as' => 'popup.store', 'uses' => 'PopupController@store'));
        Route::get('edit/{id}', array('as' => 'popup.edit', 'uses' => 'PopupController@edit'));
        Route::post('update/{id}', array('as' => 'popup.update', 'uses' => 'PopupController@update'));
        Route::post('delete', array('as' => 'popup.delete', 'uses' => 'PopupController@destroy'));
        Route::post('change-status', array('as' => 'popup.change-status', 'uses' => 'PopupController@change_status'));

    });

});

Route::group(['namespace'=>'Frontend'], function(){
    Route::resource('subcategory', 'SubCategoryController');
    Route::get('show/{name}', 'SubCategoryController@show')->name('subcategory.show');
    Route::get('show/{name}', 'CategoryController@show')->name('categories.show');

    Route::resource('news','NewsController');
    Route::get('news/{slug}', 'NewsController@show')->name('news.show');
    Route::resource('galleries', 'GalleryController');
    Route::resource('galleries', 'GalleryController');
    Route::get('galleries/{id}', 'GalleryController@show')->name('galleries.show');
    Route::get('/video',  'VideoController@index')->name('video.index');

});

