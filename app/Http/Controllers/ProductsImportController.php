<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFileRequest;
use App\Platform;
use App\Product;
use App\Services\UploadToDatabase;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ProductsImportController extends Controller
{

    private $importer;
    public function __construct(UploadToDatabase $upload)
    {
        $this->importer=$upload;
    }

    public function importForm()
    {
        return view('import.import');
    }


    public function import(StoreFileRequest $request)
    {
        $filename = $request->file('file');

        $error = $this->importer->validate($filename);

        if ($error !== null) {
            return redirect()->back()->with('error', $error);
        }

        $this->importer->upload($filename);

        return redirect()->back()->with('success', 'File uploaded successfully.');
    }
}
