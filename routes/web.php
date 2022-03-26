<?php

use Illuminate\Support\Facades\Route;

Route::prefix('back_office')->group(function () {

    Route::get('/login', 'BackOffice\Auth\LoginController@showLoginForm')->name('back.login');
    Route::post('/login', 'BackOffice\Auth\LoginController@login');

    Route::prefix('secure')->group(function() {
        Route::get('/', 'BackOffice\Secure\HomeController@index')->name('back.secure.home');

        Route::post('/logout', 'BackOffice\Auth\LoginController@logout')->name('back.secure.logout');
        Route::post('/change/password', 'BackOffice\Secure\HomeController@changePassword')->name('back.secure.change.password');

        Route::get('/subjects', 'BackOffice\Secure\SubjectController@index')->name('back.secure.subject.home');
        Route::get('/subjects/new', 'BackOffice\Secure\SubjectController@create')->name('back.secure.subject.create');
        Route::post('/subjects/store', 'BackOffice\Secure\SubjectController@store')->name('back.secure.subject.store');
        Route::delete('/subjects/remove/{id}', 'BackOffice\Secure\SubjectController@destroy')->name('back.secure.subject.delete');
        Route::post('/subjects/tags/store', 'BackOffice\Secure\SubjectController@storeTags')->name('back.secure.subject.tags.store');

        Route::post('/subjects/category/store', 'BackOffice\Secure\SubjectController@storeCategory')->name('back.secure.subject.category.store');

        Route::get('/students', 'BackOffice\Secure\StudentController@index')->name('back.secure.student.home');
        Route::get('/students/search', 'BackOffice\Secure\StudentController@search')->name('back.secure.student.search');

        Route::get('/teachers', 'BackOffice\Secure\TeacherController@index')->name('back.secure.teacher.home');
        Route::get('/teachers/search', 'BackOffice\Secure\TeacherController@search')->name('back.secure.teacher.search');
        Route::get('/teachers/{id}', 'BackOffice\Secure\TeacherController@show')->name('back.secure.teacher.details');
        Route::get('/teachers/validation/{id}', 'BackOffice\Secure\TeacherController@validation')->name('back.secure.teacher.validation');
        Route::post('/teachers/review/{id}', 'BackOffice\Secure\TeacherController@review')->name('back.secure.teacher.review');
        Route::get('/stats','BackOffice\Secure\StatsController@index')->name('back.secure.stats.home');
    });
});

Route::redirect('/', '/en');

Route::group(['prefix' => '{language}'], function() {
    Route::get('/', 'FrontOffice\Guest\HomeController@index')->name('front.home');
    Route::get('/about', 'FrontOffice\Guest\HomeController@about')->name('front.about');
    Route::get('/contact', 'FrontOffice\Guest\HomeController@contact')->name('front.contact');
    Route::get('/teachers', 'FrontOffice\Guest\TeacherController@index')->name('front.teachers');
    Route::get('/teacher/{id?}', 'FrontOffice\Guest\TeacherController@loadOne')->name('front.secure.profile');
    Route::post('/teachers/rate', 'FrontOffice\Guest\TeacherController@rate');
    Route::get('/subjects', 'FrontOffice\Guest\SubjectController@index')->name('front.subjects');

    Route::get('/search', 'FrontOffice\Guest\SearchController@index')->name('front.search.home');


    Route::get('/sign-in', 'FrontOffice\Auth\LoginController@showLoginForm')->name('front.signin');
    Route::get('/sign-up', 'FrontOffice\Auth\LoginController@showRegisterForm')->name('front.signup');

    Route::post('/sign-in', 'FrontOffice\Auth\LoginController@login')->name('front.login');
    Route::post('/sign-up', 'FrontOffice\Auth\LoginController@register')->name('front.register');
    Route::post('/sign-out', 'FrontOffice\Auth\LoginController@logout')->name('front.signout');

    Route::prefix('account')->group(function() {
        // Route::get('/create/step1', 'FrontOffice\secure\CreatProfileController@step1')->name('front.secure.profile.step1');
        Route::get('/create/step1', 'FrontOffice\Auth\LoginController@step1')->name('front.secure.profile.step1');
        Route::post('/create/step1', 'FrontOffice\secure\CreatProfileController@SaveStep1')->name('front.secure.profile.saveStep1');
        Route::get('/create/step2', 'FrontOffice\secure\CreatProfileController@step2')->name('front.secure.profile.step2');
        Route::post('/create/step2', 'FrontOffice\secure\CreatProfileController@SaveStep2')->name('front.secure.profile.saveStep2');
        Route::get('/create/step3', 'FrontOffice\secure\CreatProfileController@step3')->name('front.secure.profile.step3');
        Route::post('/create/step3', 'FrontOffice\secure\CreatProfileController@SaveStep3')->name('front.secure.profile.saveStep3');
        Route::get('/create/step4', 'FrontOffice\secure\CreatProfileController@step4')->name('front.secure.profile.step4');
        Route::post('/create/step4', 'FrontOffice\secure\CreatProfileController@SaveStep4')->name('front.secure.profile.saveStep4');

    });
});





