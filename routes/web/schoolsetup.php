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
    Route::get('/schoolinfo', 'Web\Admin\SchoolSetupController@schoolinfo')->name('schoolinfo');
    Route::post('/schoolinfo/update', 'Web\Admin\SchoolSetupController@schoolinfo_update')->name('schoolinfo.update');
    Route::get('/setmaxlc', 'Web\Admin\SchoolSetupController@setmaxlc')->name('setmaxlc');
    Route::post('/setmaxlc/update', 'Web\Admin\SchoolSetupController@setmaxlc_update')->name('setmaxlc.update');
    Route::get('/academicyear', 'Web\Admin\SchoolSetupController@academicyear')->name('academicyear');
    Route::post('/academicyear/add', 'Web\Admin\SchoolSetupController@academicyear_add')->name('academicyear.add');
    Route::get('/academicyear/delete/{id}', 'Web\Admin\SchoolSetupController@academicyear_delete')->name('academicyear.delete');
    Route::get('/religion', 'Web\Admin\SchoolSetupController@religion')->name('religion');
    Route::post('/religion/add', 'Web\Admin\SchoolSetupController@religion_add')->name('religion.add');
    Route::get('/religion/edit/{id}', 'Web\Admin\SchoolSetupController@religion_edit')->name('religion.edit');
    Route::post('/religion/editreligion', 'Web\Admin\SchoolSetupController@religion_editreligion')->name('religion.editreligion');
    Route::get('/religion/delete/{id}', 'Web\Admin\SchoolSetupController@religion_delete')->name('religion.delete');
    Route::get('/category', 'Web\Admin\SchoolSetupController@category')->name('category');
    Route::post('/category/add', 'Web\Admin\SchoolSetupController@category_add')->name('category.add');
    Route::get('/category/edit/{id}', 'Web\Admin\SchoolSetupController@category_edit')->name('category.edit');
    Route::post('/category/editcategory', 'Web\Admin\SchoolSetupController@category_editcategory')->name('category.editcategory');
    Route::get('/category/delete/{id}', 'Web\Admin\SchoolSetupController@category_delete')->name('category.delete');
    Route::get('/castecategories', 'Web\Admin\SchoolSetupController@castecategories')->name('castecategories');
    Route::post('/castecategory/add', 'Web\Admin\SchoolSetupController@castecategory_add')->name('castecategory.add');
    Route::get('/castecategory/edit/{id}', 'Web\Admin\SchoolSetupController@castecategory_edit')->name('castecategory.edit');
    Route::post('/castecategory/editcastecategory', 'Web\Admin\SchoolSetupController@castecategory_editcastecategory')->name('castecategory.editcastecategory');
    Route::get('/castecategory/delete/{id}', 'Web\Admin\SchoolSetupController@castecategory_delete')->name('castecategory.delete');
    Route::get('/designation', 'Web\Admin\SchoolSetupController@designation')->name('designation');
    Route::post('/designation/add', 'Web\Admin\SchoolSetupController@designation_add')->name('designation.add');
    Route::get('/designation/edit/{id}', 'Web\Admin\SchoolSetupController@designation_edit')->name('designation.edit');
    Route::post('/designation/editdesignation', 'Web\Admin\SchoolSetupController@designation_editdesignation')->name('designation.editdesignation');
    Route::get('/designation/delete/{id}', 'Web\Admin\SchoolSetupController@designation_delete')->name('designation.delete');
    Route::get('/division', 'Web\Admin\SchoolSetupController@division')->name('division');
    Route::post('/division/add', 'Web\Admin\SchoolSetupController@division_add')->name('division.add');
    Route::get('/division/edit/{id}', 'Web\Admin\SchoolSetupController@division_edit')->name('division.edit');
    Route::post('/division/editdivision', 'Web\Admin\SchoolSetupController@division_editdivision')->name('division.editdivision');
    Route::get('/division/delete/{id}', 'Web\Admin\SchoolSetupController@division_delete')->name('division.delete');
    Route::get('/classes', 'Web\Admin\SchoolSetupController@classes')->name('classes');
    Route::post('/classes/add', 'Web\Admin\SchoolSetupController@classes_add')->name('classes.add');
    Route::get('/classes/edit/{id}', 'Web\Admin\SchoolSetupController@classes_edit')->name('classes.edit');
    Route::post('/classes/editclass', 'Web\Admin\SchoolSetupController@classes_editclass')->name('classes.editclass');
    Route::get('/classes/delete/{id}', 'Web\Admin\SchoolSetupController@classes_delete')->name('classes.delete');
    Route::get('/subjects', 'Web\Admin\SchoolSetupController@subjects')->name('subjects');
    Route::post('/subjects/add', 'Web\Admin\SchoolSetupController@subjects_add')->name('subjects.add');
    Route::get('/subjects/edit/{id}', 'Web\Admin\SchoolSetupController@subjects_edit')->name('subjects.edit');
    Route::post('/subjects/editsubject', 'Web\Admin\SchoolSetupController@subjects_editsubject')->name('subjects.editsubject');
    Route::get('/subjects/delete/{id}', 'Web\Admin\SchoolSetupController@subjects_delete')->name('subjects.delete');
    Route::get('/assignsubjects', 'Web\Admin\SchoolSetupController@assignsubjects')->name('assignsubjects');
    Route::post('/assignsubjects/add', 'Web\Admin\SchoolSetupController@assignsubjects_add')->name('assignsubjects.add');
    Route::get('/assignclassteacher', 'Web\Admin\SchoolSetupController@assignclassteacher')->name('assignclassteacher');
    Route::post('/assignclassteacher/add', 'Web\Admin\SchoolSetupController@assignclassteacher_add')->name('assignclassteacher.add');
    Route::get('/assignclassteacher/edit/{id}', 'Web\Admin\SchoolSetupController@assignclassteacher_edit')->name('assignclassteacher.edit');
    Route::post('/assignclassteacher/editclassteacher', 'Web\Admin\SchoolSetupController@assignclassteacher_editclassteacher')->name('assignclassteacher.editclassteacher');
    Route::get('/assignclassteacher/delete/{id}', 'Web\Admin\SchoolSetupController@assignclassteacher_delete')->name('assignclassteacher.delete');

    Route::get('/assignexaminer', 'Web\Admin\SchoolSetupController@assignexaminer')->name('assignexaminer');
    Route::post('/assignexaminer/add', 'Web\Admin\SchoolSetupController@assignexaminer_add')->name('assignexaminer.add');
    Route::get('/assignexaminer/delete/{id}', 'Web\Admin\SchoolSetupController@assignexaminer_delete')->name('assignexaminer.delete');

    Route::get('/classtimetable', 'Web\Admin\SchoolSetupController@classtimetable')->name('classtimetable');
    Route::get('/timetablecalender', 'Web\Admin\SchoolSetupController@timetablecalender')->name('timetablecalender');
    Route::post('/classtimetable/add', 'Web\Admin\SchoolSetupController@classtimetable_add')->name('classtimetable.add');
    Route::get('/scholarship', 'Web\Admin\SchoolSetupController@scholarship')->name('scholarship');
    Route::post('/scholarship/add', 'Web\Admin\SchoolSetupController@scholarship_add')->name('scholarship.add');
    Route::get('/scholarship/edit/{id}', 'Web\Admin\SchoolSetupController@scholarship_edit')->name('scholarship.edit');
    Route::post('/scholarship/editscholarship', 'Web\Admin\SchoolSetupController@scholarship_editscholarship')->name('scholarship.editscholarship');
    Route::get('/scholarship/delete/{id}', 'Web\Admin\SchoolSetupController@scholarship_delete')->name('scholarship.delete');
    Route::get('/event', 'Web\Admin\SchoolSetupController@event')->name('event');
    Route::post('/event/add', 'Web\Admin\SchoolSetupController@event_add')->name('event.add');
    Route::get('/event/edit/{id}', 'Web\Admin\SchoolSetupController@event_edit')->name('event.edit');
    Route::post('/event/editevent', 'Web\Admin\SchoolSetupController@event_editevent')->name('event.editevent');
    Route::get('/event/delete/{id}', 'Web\Admin\SchoolSetupController@event_delete')->name('event.delete');
    Route::get('/holiday', 'Web\Admin\SchoolSetupController@holiday')->name('holiday');
    Route::post('/holiday/add', 'Web\Admin\SchoolSetupController@holiday_add')->name('holiday.add');
    Route::get('/holiday/edit/{id}', 'Web\Admin\SchoolSetupController@holiday_edit')->name('holiday.edit');
    Route::post('/holiday/editholiday', 'Web\Admin\SchoolSetupController@holiday_editholiday')->name('holiday.editholiday');
    Route::get('/holiday/delete/{id}', 'Web\Admin\SchoolSetupController@holiday_delete')->name('holiday.delete');
    Route::get('/otherschools', 'Web\Admin\SchoolSetupController@otherschools')->name('otherschools');
    Route::post('/otherschools/add', 'Web\Admin\SchoolSetupController@otherschools_add')->name('otherschools.add');
    Route::get('/otherschools/edit/{id}', 'Web\Admin\SchoolSetupController@otherschools_edit')->name('otherschools.edit');
    Route::post('/otherschools/editschool', 'Web\Admin\SchoolSetupController@otherschools_editschool')->name('otherschools.editschool');
    Route::get('/otherschools/delete/{id}', 'Web\Admin\SchoolSetupController@otherschools_delete')->name('otherschools.delete');

    Route::get('/resetpassword', 'Web\Admin\SchoolSetupController@resetpassword')->name('resetpassword');
    Route::post('/resetpassword/reset', 'Web\Admin\SchoolSetupController@resetpassword_reset')->name('resetpassword.reset');

});
