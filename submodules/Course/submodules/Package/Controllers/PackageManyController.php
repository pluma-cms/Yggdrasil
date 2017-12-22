<?php

namespace Package\Controllers;

use Frontier\Controllers\AdminController;
use Illuminate\Http\Request;
use Library\Models\Library;
use Package\Models\Package;
use Package\Requests\PackageRequest;

class PackageManyController extends AdminController
{
    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        foreach ($request->input('packages') as $package_id) {
            $library = Library::findOrFail($package_id);
            $library->delete();
        }

        return back();
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  \Package\Requests\PackageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function restore(PackageRequest $request)
    {
        //

        return back();
    }

    /**
     * Delete the specified resource from storage permanently.
     *
     * @param  \Package\Requests\PackageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function delete(PackageRequest $request)
    {
        //

        return redirect()->route('packages.trash');
    }
}
