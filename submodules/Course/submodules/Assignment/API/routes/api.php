<?php

Route::delete('assignments/destroy/{assignment}', 'Assignment\API\Controllers\AssignmentController@destroy')->name('assignments.destroy');
Route::delete('assignments/delete/{assignment}', 'Assignment\API\Controllers\AssignmentController@delete')->name('assignments.delete');
Route::get('assignments/all', 'Assignment\API\Controllers\AssignmentController@all')->name('assignments.all');
Route::get('assignments/search', 'Assignment\API\Controllers\AssignmentController@search')->name('assignments.search');
Route::get('assignments/trash/all', 'Assignment\API\Controllers\AssignmentController@getTrash')->name('assignments.trash.all');
Route::post('assignments/grants', 'Assignment\API\Controllers\AssignmentController@grants')->name('assignments.grants');
Route::post('assignments/{assignment}/clone', 'Assignment\API\Controllers\AssignmentController@clone')->name('assignments.clone');
Route::post('assignments/{assignment}/restore', 'Assignment\API\Controllers\AssignmentController@restore')->name('assignments.restore');
