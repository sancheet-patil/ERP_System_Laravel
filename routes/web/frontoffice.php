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

Route::group(['middleware' => ['auth','disablemoveback']], function() {
    Route::get('/visitorbook', 'Web\Admin\FrontOfficeController@visitorbook')->name('visitorbook');
    Route::post('/visitorbook/add', 'Web\Admin\FrontOfficeController@visitorbook_add')->name('visitorbook.add');
    Route::get('/visitorbook/edit/{id}', 'Web\Admin\FrontOfficeController@visitorbook_edit')->name('visitorbook.edit');
    Route::post('/visitorbook/editvisitor', 'Web\Admin\FrontOfficeController@visitorbook_editvisitor')->name('visitorbook.editvisitor');
    Route::get('/visitorbook/delete/{id}', 'Web\Admin\FrontOfficeController@visitorbook_delete')->name('visitorbook.delete');

    Route::get('/outwards', 'Web\Admin\FrontOfficeController@outwards')->name('outwards');
    Route::post('/outwards/add', 'Web\Admin\FrontOfficeController@outwards_add')->name('outwards.add');
    Route::get('/outwards/edit/{id}', 'Web\Admin\FrontOfficeController@outwards_edit')->name('outwards.edit');
    Route::post('/outwards/editoutwards', 'Web\Admin\FrontOfficeController@outwards_editoutwards')->name('outwards.editoutwards');
    Route::get('/outwards/delete/{id}', 'Web\Admin\FrontOfficeController@outwards_delete')->name('outwards.delete');

    Route::get('/inwards', 'Web\Admin\FrontOfficeController@inwards')->name('inwards');
    Route::post('/inwards/add', 'Web\Admin\FrontOfficeController@inwards_add')->name('inwards.add');
    Route::get('/inwards/edit/{id}', 'Web\Admin\FrontOfficeController@inwards_edit')->name('inwards.edit');
    Route::post('/inwards/editinwards', 'Web\Admin\FrontOfficeController@inwards_editinwards')->name('inwards.editinwards');
    Route::get('/inwards/delete/{id}', 'Web\Admin\FrontOfficeController@inwards_delete')->name('inwards.delete');

    Route::get('/complaints', 'Web\Admin\FrontOfficeController@complaints')->name('complaints');
    Route::post('/complaints/add', 'Web\Admin\FrontOfficeController@complaints_add')->name('complaints.add');
    Route::get('/complaints/edit/{id}', 'Web\Admin\FrontOfficeController@complaints_edit')->name('complaints.edit');
    Route::post('/complaints/editcomplaint', 'Web\Admin\FrontOfficeController@complaints_editcomplaint')->name('complaints.editcomplaint');
    Route::get('/complaints/delete/{id}', 'Web\Admin\FrontOfficeController@complaints_delete')->name('complaints.delete');

    Route::get('/circular', 'Web\Admin\FrontOfficeController@circular')->name('circular');
    Route::post('/circular/add', 'Web\Admin\FrontOfficeController@circular_add')->name('circular.add');
    Route::get('/circular/delete/{id}', 'Web\Admin\FrontOfficeController@circular_delete')->name('circular.delete');
});
