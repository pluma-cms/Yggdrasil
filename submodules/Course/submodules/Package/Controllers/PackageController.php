<?php

namespace Package\Controllers;

use Frontier\Controllers\AdminController;
use Illuminate\Http\Request;
use Library\Models\Library;
use Package\Models\Package;
use Package\Requests\PackageRequest;

class PackageController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $resources = Library::ofCatalogue('package')->paginate();

        return view("Theme::packages.index")->with(compact('resources'));
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

        return view("Theme::packages.show");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view("Theme::packages.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Package\Requests\PackageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PackageRequest $request)
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

        return view("Theme::packages.edit");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Package\Requests\PackageRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PackageRequest $request, $id)
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

        return redirect()->route('packages.index');
    }

    /**
     * Display a listing of the trashed resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function trash()
    {
        //

        return view("Theme::packages.trash");
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  \Package\Requests\PackageRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore(PackageRequest $request, $id)
    {
        //

        return back();
    }

    /**
     * Delete the specified resource from storage permanently.
     *
     * @param  \Package\Requests\PackageRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(PackageRequest $request, $id)
    {
        //

        return redirect()->route('packages.trash');
    }
}
