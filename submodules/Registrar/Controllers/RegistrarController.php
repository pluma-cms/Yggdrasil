<?php

namespace Registrar\Controllers;

use Frontier\Controllers\AdminController;
use Illuminate\Http\Request;
use Registrar\Models\Registrar;
use Registrar\Requests\RegistrarRequest;

class RegistrarController extends AdminController
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

        return view("Theme::registrars.index");
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

        return view("Theme::registrars.show");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view("Theme::registrars.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Registrar\Requests\RegistrarRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RegistrarRequest $request)
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

        return view("Theme::registrars.edit");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Registrar\Requests\RegistrarRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RegistrarRequest $request, $id)
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

        return redirect()->route('registrars.index');
    }

    /**
     * Display a listing of the trashed resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function trash()
    {
        //

        return view("Theme::registrars.trash");
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  \Registrar\Requests\RegistrarRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore(RegistrarRequest $request, $id)
    {
        //

        return back();
    }

    /**
     * Delete the specified resource from storage permanently.
     *
     * @param  \Registrar\Requests\RegistrarRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(RegistrarRequest $request, $id)
    {
        //

        return redirect()->route('registrars.trash');
    }
}
