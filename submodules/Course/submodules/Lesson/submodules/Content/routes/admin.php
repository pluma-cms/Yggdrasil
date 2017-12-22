<?php

// Route::resource('{courses}/{lessons}/contents', 'Content\Controllers\ContentController');
Route::group(['prefix' => 'courses/{course}/{lessons}'], function () {
    Route::get('{content}', 'Content\Controllers\ContentController@show')->name('contents.show');
});
