<?php
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {

    /*********** Groupe of routes with authorizted access **********/
    Route::prefix('gate')->group(function () {
        Route::post('sign_in', 'Api\V1\SecurityController@signIn');
        Route::post('sign_up', 'Api\V1\SecurityController@signUp');
        Route::post('refresh', 'Api\V1\SecurityController@refresh');
    });

    Route::prefix('teachers')->group(function() {
        Route::get('/load_all', 'Api\V1\TeacherController@loadAll');
        Route::get('/load_min_max', 'Api\V1\TeacherController@pricingMinMax');
        Route::get('/load_one/{id}', 'Api\V1\TeacherController@getOne');
        Route::get('/search', 'Api\V1\TeacherController@search');
    });

    Route::get('load_popular', 'Api\V1\HomeController@loadPopular');

    Route::prefix('subjects')->group(function() {
        Route::get('load_all', 'Api\V1\SubjectController@loadAll');
        Route::get('{id}/load_teachers', 'Api\V1\SubjectController@loadTeachersBySubject');
    });

    Route::prefix('locations')->group(function() {
        Route::get('load_all', 'Api\V1\Locationcontroller@loadAll');
    });

    Route::prefix('restricted')->middleware('auth:api')->group(function(){
        Route::post('/teachers/{id}/rate', 'Api\V1\TeacherController@rate');
    });
});

Route::get('/fetch_data', 'Api\V1\HomeController@index');
Route::post('/find_subjects', 'Api\V1\SubjectController@search');

Route::prefix('subjects')->group(function() {
    Route::get('/load_all', 'Api\V1\SubjectController@index');
});