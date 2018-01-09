<?php


// Enroll (not Enrolled, not past tense)
Route::get('enroll-test/{course}/{user}', '\Course\Controllers\EnrollController@enroll');
Route::post('courses/{course}/{user}', '\Course\Controllers\EnrollController@enroll')->name('courses.enroll');

Route::get('courses/categories', '\Course\Controllers\CategoryController@index')->name('courses.categories.index');
Route::resource('courses', '\Course\Controllers\CourseController');

