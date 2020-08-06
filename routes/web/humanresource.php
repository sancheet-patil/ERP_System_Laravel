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
    Route::get('/staff/joining', 'Web\Admin\HumanResourceController@staff_joining')->name('staff.joining');
    Route::post('/staff/joining/add', 'Web\Admin\HumanResourceController@staff_joining_add')->name('staff.joining.add');
    Route::get('/staff/view/{id}', 'Web\Admin\HumanResourceController@staff_view')->name('staff.view');
    Route::get('/staff/delete/{id}', 'Web\Admin\HumanResourceController@staff_delete')->name('staff.delete');
    Route::get('/staff/editjoining/{id}', 'Web\Admin\HumanResourceController@staff_editjoining')->name('staff.editjoining');
    Route::post('/staff/editjoining/edit', 'Web\Admin\HumanResourceController@staff_editjoining_edit')->name('staff.editjoining.edit');
    Route::get('/staff/search', 'Web\Admin\HumanResourceController@staff_search')->name('staff.search');
    Route::get('/staff/editsearch/{id}', 'Web\Admin\HumanResourceController@staff_editsearch')->name('staff.editsearch');
    Route::post('/staff/editsearch/edit', 'Web\Admin\HumanResourceController@staff_editsearch_edit')->name('staff.editsearch.edit');
    Route::get('/staffidgenerate', 'Web\Admin\HumanResourceController@staffidgenerate')->name('staffidgenerate');
    Route::get('/staff/idgenerate/{id}', 'Web\Admin\HumanResourceController@staff_idgenerate')->name('staff.idgenerate');
    Route::get('/staffidgenerate/bulk', 'Web\Admin\HumanResourceController@staffidgenerate_bulk')->name('staffidgenerate.bulk');
    Route::post('/staffidgenerate/bulk/post', 'Web\Admin\HumanResourceController@staffidgenerate_bulk_post')->name('staffidgenerate.bulk.post');
    Route::get('/staffid/bulk/print', 'Web\Admin\HumanResourceController@staffid_bulk_print')->name('staffid.bulk.print');

});
