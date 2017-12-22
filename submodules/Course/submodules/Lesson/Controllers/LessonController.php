<?php

namespace Lesson\Controllers;

use Frontier\Controllers\AdminController;
use Illuminate\Http\Request;
use Lesson\Models\Lesson;
use Lesson\Requests\LessonRequest;

class LessonController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //

        return view("Theme::lessons.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        //

        return view("Theme::lessons.show");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view("Theme::lessons.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Lesson\Requests\LessonRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LessonRequest $request)
    {
        //

        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        //

        return view("Theme::lessons.edit");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Lesson\Requests\LessonRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(LessonRequest $request, $id)
    {
        //

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        //

        return redirect()->route('lessons.index');
    }

    /**
     * Display a listing of the trashed resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function trash()
    {
        //

        return view("Theme::lessons.trash");
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  \Lesson\Requests\LessonRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore(LessonRequest $request, $id)
    {
        //

        return back();
    }

    /**
     * Delete the specified resource from storage permanently.
     *
     * @param  \Lesson\Requests\LessonRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(LessonRequest $request, $id)
    {
        //

        return redirect()->route('lessons.trash');
    }
}
