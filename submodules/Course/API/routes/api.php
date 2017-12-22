<?php

// Scormvar
Route::get('scorm/courses/{course}/{content}', 'Course\API\Controllers\ScormvarController@LMSGetValue')->name('scorm.lmsgetvalue');
Route::post('scorm/courses/{course}/{content}/init', 'Course\API\Controllers\ScormvarController@LMSInitialize')->name('scorm.lmsinitialize');
Route::post('scorm/courses/{course}/{content}', 'Course\API\Controllers\ScormvarController@LMSSetValue')->name('scorm.lmssetvalue');
Route::post('scorm/courses/{course}/{content}/commit', 'Course\API\Controllers\ScormvarController@LMSCommit')->name('scorm.lmscommit');
Route::post('scorm/courses/{course}/{content}/finish', 'Course\API\Controllers\ScormvarController@LMSFinish')->name('scorm.lmsfinish');

// Bookmark
Route::post('courses/unbookmark/{course}', 'Course\API\Controllers\BookmarkCourseController@unbookmark')->name('courses.bookmark.unbookmark');
Route::post('courses/bookmark/{course}', 'Course\API\Controllers\BookmarkCourseController@bookmark')->name('courses.bookmark.bookmark');

// My
Route::get('courses/enrolled', 'Course\API\Controllers\MyCourseController@all')->name('courses.enrolled.index');

Route::delete('courses/destroy/{course}', 'Course\API\Controllers\CourseController@destroy')->name('courses.destroy');
Route::delete('courses/delete/{course}', 'Course\API\Controllers\CourseController@delete')->name('courses.delete');
Route::get('courses/all', 'Course\API\Controllers\CourseController@all')->name('courses.all');
Route::get('courses/search', 'Course\API\Controllers\CourseController@search')->name('courses.search');
Route::get('courses/trash/all', 'Course\API\Controllers\CourseController@getTrash')->name('courses.trash.all');
Route::post('courses/grants', 'Course\API\Controllers\CourseController@grants')->name('courses.grants');
Route::post('courses/{course}/clone', 'Course\API\Controllers\CourseController@clone')->name('courses.clone');
Route::post('courses/{course}/restore', 'Course\API\Controllers\CourseController@restore')->name('courses.restore');
