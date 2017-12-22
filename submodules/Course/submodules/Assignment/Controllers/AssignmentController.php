<?php

namespace Assignment\Controllers;

use Frontier\Controllers\AdminController;
use Illuminate\Http\Request;
use Assignment\Models\Assignment;
use Assignment\Requests\AssignmentRequest;

class AssignmentController extends AdminController
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

        return view("Theme::assignments.index");
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

        return view("Theme::assignments.show");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view("Theme::assignments.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Assignment\Requests\AssignmentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AssignmentRequest $request)
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

        return view("Theme::assignments.edit");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Assignment\Requests\AssignmentRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AssignmentRequest $request, $id)
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

        return redirect()->route('assignments.index');
    }

    /**
     * Display a listing of the trashed resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function trash()
    {
        //

        return view("Theme::assignments.trash");
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  \Assignment\Requests\AssignmentRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore(AssignmentRequest $request, $id)
    {
        //

        return back();
    }

    /**
     * Delete the specified resource from storage permanently.
     *
     * @param  \Assignment\Requests\AssignmentRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(AssignmentRequest $request, $id)
    {
        //

        return redirect()->route('assignments.trash');
    }
}
