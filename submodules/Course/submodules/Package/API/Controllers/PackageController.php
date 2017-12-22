<?php

namespace Package\API\Controllers;

use Catalogue\Models\Catalogue;
use Illuminate\Http\Request;
use Library\Models\Library;
use Library\Requests\LibraryRequest;
use Pluma\API\Controllers\APIController;

class PackageController extends APIController
{
    /**
     * Return a paginated resource.
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function paginated(Request $request)
    {
        $onlyTrashed = $request->get('trashedOnly') !== 'null' && $request->get('trashedOnly') ? $request->get('trashedOnly'): false;
        $order = $request->get('descending') === 'true' && $request->get('descending') !== 'null' ? 'DESC' : 'ASC';
        $search = $request->get('q') !== 'null' && $request->get('q') ? $request->get('q'): '';
        $sort = $request->get('sort') && $request->get('sort') !== 'null' ? $request->get('sort') : 'id';
        $take = $request->get('take') && $request->get('take') > 0 ? $request->get('take') : 0;

        $resources = Library::ofCatalogue('package')->search($search)->orderBy($sort, $order);
        if ($onlyTrashed) {
            $resources->onlyTrashed();
        }

        if ($request->input('catalogue_id') && $request->input('catalogue_id') != 'undefined' && $request->input('catalogue_id') != 0) {
            $resources->where('catalogue_id', $request->input('catalogue_id'));
        }

        $resources = $take ? $resources->paginate($take) : $resources->get();

        return response()->json($resources);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Library\Requests\LibraryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function upload(LibraryRequest $request)
    {
        try {
            $file = $request->file('file');

            if (is_array($file) && $files = $file) {
                foreach ($files as $file) {
                    $this->save($request, $file);
                }
            } else {
                $this->save($request, $file);
            }
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }

        return response()->json($this->successResponse);
    }

    /**
     * Save the library.
     *
     * @param  File $file
     * @return boolean
     */
    public function save($request, $file)
    {
        $originalName = $file->getClientOriginalName();
        $date = date('Y-m-d');
        $filePath = storage_path(settings('library.storage_path', 'public/library')) . "/$date";

        $name = (bool) $request->input('originalname') ? pathinfo($request->input('originalname'), PATHINFO_FILENAME) : pathinfo($originalName, PATHINFO_FILENAME);

        $fileName = str_slug($name);
        $fileName .= ".".$file->getClientOriginalExtension();

        $fullFilePath = "$filePath/$fileName";

        if ($file->move($filePath, $fileName)) {

            $library = new Library();
            $library->name = $name;
            $library->originalname = $originalName;
            $library->pathname = $fullFilePath;
            $library->mimetype = $file->getClientMimeType();
            $library->size = $file->getClientSize();
            $library->url = settings('library.storage_path', 'public/library') . "/$date/$fileName";
            if ((bool) $request->input('catalogue')) {
                $library->catalogue()->associate(Catalogue::whereCode($request->input('catalogue'))->firstOrCreate(['code' => $request->input('catalogue')],[
                    'name' => 'Package',
                    'code' => 'package',
                    'alias' => 'Archives',
                    'icon' => 'archive',
                    'description' => 'A Catalogue of eLearning Packages'
                ]));
            }
            $library->save();
            $library->thumbnail = settings('package.storage_path', 'public/package') . "/$date/{$library->id}/thumbnail.png";

            $output = storage_path(settings('package.storage_path', 'public/package'))."/$date/{$library->id}";
            Library::extract($fullFilePath, $output);
        }
    }
}
