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


Route::get('/', function () {
    return view('web/index');
})->name('/');
Route::get('/gallery', function () {
    return view('web/gallery');
})->name('gallery');
Route::get('/contact', function () {
    return view('web/contact');
})->name('contact');
Route::get('/teacher', function () {
    return view('web/teacher');
})->name('teacher');
Route::get('/download', 'Auth\AuthController@downloadapp')->name('download');

/*Route::get('/', function () {
    return Redirect::route('login');
})->name('/');*/

Auth::routes([
    'verify' => true,
    'register' => false,
    'reset' => false
]);

Route::post('/log1n', 'Auth\AuthController@login')->name('log1n');

Route::group(['middleware' => ['auth', 'disablemoveback']], function() {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/profile', 'Web\Admin\OtherController@profile')->name('profile');
    Route::post('/changeloginpassword', 'Web\Admin\OtherController@changeloginpassword');
    Route::get('/changeacademicyear/{academicyear}', 'Web\Admin\OtherController@changeacademicyear')->name('changeacademicyear');
    Route::get('/changeregisterfor/{registerfor}', 'Web\Admin\OtherController@changeregisterfor')->name('changeregisterfor');

    Route::get('/divisionlist', 'Web\Admin\OtherController@divisionlist')->name('divisionlist');
    Route::get('/getnextregisterno', 'Web\Admin\OtherController@getnextregisterno')->name('getnextregisterno');
    Route::get('/validateregisterno', 'Web\Admin\OtherController@validateregisterno')->name('validateregisterno');
    Route::get('/validateaadhar', 'Web\Admin\OtherController@validateaadhar')->name('validateaadhar');
    Route::get('/castelist', 'Web\Admin\OtherController@castelist')->name('castelist');
    Route::get('/subcastelist', 'Web\Admin\OtherController@subcastelist')->name('subcastelist');
    Route::get('/subcastedetails', 'Web\Admin\OtherController@subcastedetails')->name('subcastedetails');
    Route::get('/undividedstudents', 'Web\Admin\OtherController@undividedstudents')->name('undividedstudents');
    Route::get('/undividedcollegestudents', 'Web\Admin\OtherController@undividedcollegestudents')->name('undividedcollegestudents');
    Route::get('/dividedstudents', 'Web\Admin\OtherController@dividedstudents')->name('dividedstudents');
    Route::get('/dividedcollegestudents', 'Web\Admin\OtherController@dividedcollegestudents')->name('dividedcollegestudents');
    Route::get('/classsubjectlist', 'Web\Admin\OtherController@classsubjectlist')->name('classsubjectlist');
    Route::get('/unissuedlc', 'Web\Admin\OtherController@unissuedlc')->name('unissuedlc');
    Route::get('/collegeunissuedlc', 'Web\Admin\OtherController@collegeunissuedlc')->name('collegeunissuedlc');
    Route::get('/studentdetails', 'Web\Admin\OtherController@studentdetails')->name('studentdetails');
    Route::get('/form17lcunissuedstudents', 'Web\Admin\OtherController@form17lcunissuedstudents')->name('form17lcunissuedstudents');
    Route::get('/bonafidestudents', 'Web\Admin\OtherController@bonafidestudents')->name('bonafidestudents');
    Route::get('/collegebonafidestudents', 'Web\Admin\OtherController@collegebonafidestudents')->name('collegebonafidestudents');
    Route::get('/isclassteacher', 'Web\Admin\OtherController@isclassteacher')->name('isclassteacher');
    Route::get('/scholarshipdetails', 'Web\Admin\OtherController@scholarshipdetails')->name('scholarshipdetails');
    Route::post('/scholarshipstudents', 'Web\Admin\OtherController@scholarshipstudents')->name('scholarshipstudents');

    Route::get('/migrate', 'Web\Admin\OtherController@migrate')->name('migrate');


});
