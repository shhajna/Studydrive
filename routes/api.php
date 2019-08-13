<?php

Route::post('students', 'StudentController@store');

Route::group(['middleware' => 'auth:api'], function () {
    Route::apiResource('students', 'StudentController')->except('store');

    Route::apiResource('courses', 'CourseController');
    Route::post('courses/{course_id}/register', 'CourseController@register');
    Route::post('courses/{course_id}/unregister', 'CourseController@unregister');
});