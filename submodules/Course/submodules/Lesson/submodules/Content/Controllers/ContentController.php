<?php

namespace Content\Controllers;

use Content\Models\Content;
use Content\Requests\ContentRequest;
use Course\Models\Course;
use Frontier\Controllers\AdminController;
use Illuminate\Http\Request;

class ContentController extends AdminController
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

        return view("Theme::contents.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $course, $lesson, $id)
    {
        $resource = Content::findOrFail($id);
        $contents = $resource->lesson->contents;

        return view("Theme::contents.show")->with(compact('resource', 'contents'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view("Theme::contents.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Content\Requests\ContentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContentRequest $request)
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

        return view("Theme::contents.edit");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Content\Requests\ContentRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ContentRequest $request, $id)
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

        return redirect()->route('contents.index');
    }

    /**
     * Display a listing of the trashed resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function trash()
    {
        //

        return view("Theme::contents.trash");
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  \Content\Requests\ContentRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore(ContentRequest $request, $id)
    {
        //

        return back();
    }

    /**
     * Delete the specified resource from storage permanently.
     *
     * @param  \Content\Requests\ContentRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(ContentRequest $request, $id)
    {
        //

        return redirect()->route('contents.trash');
    }
}
