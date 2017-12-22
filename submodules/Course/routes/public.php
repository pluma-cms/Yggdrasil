<?php

// Bookmarks
Route::post('courses/unbookmark/{course}', 'Course\Controllers\BookmarkCourseController@unbookmark')->name('courses.bookmark.unbookmark');
Route::post('courses/bookmark/{course}', 'Course\Controllers\BookmarkCourseController@bookmark')->name('courses.bookmark.bookmark');
Route::get('courses/bookmarked', 'Course\Controllers\BookmarkCourseController@index')->name('courses.bookmark.index');

// Enrolled
Route::get('courses/enrolled/{course}', 'Course\Controllers\EnrollController@show')->name('courses.enrolled.show');
Route::get('courses/enrolled', 'Course\Controllers\EnrollController@index')->name('courses.enrolled.index');

// Public Courses
Route::get('courses/{course}', 'Course\Controllers\CourseController@show')->name('courses.show');
Route::get('courses', 'Course\Controllers\CourseController@index')->name('courses.index');
