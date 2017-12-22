<?php

namespace Course\Controllers;

use Illuminate\Http\Request;

class CategoryController
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $courses = [];//Category::where('categorable_type');

        return view("Theme::categories.index")->with(compact('courses'));
    }
}
