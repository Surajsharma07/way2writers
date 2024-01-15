<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class DownloadController extends Controller
{
    public function download($file)
    {
        // Perform any necessary validation or authorization checks here

        // Assuming the files are stored in the storage/app/public directory
        $filePath = storage_path("app/public/{$file}");

        if (file_exists($filePath)) {
            return response()->download($filePath);
        } else {
            abort(404, 'File not found');
        }
    }
}
