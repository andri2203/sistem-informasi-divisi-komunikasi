<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileHandleController extends Controller
{
    public function index($target, $image)
    {
        $file = Storage::get($target.'/' . $image);
        $mimetype = Storage::mimeType($target.'/' . $image);
        return response($file, 200)->header('Content-Type', $mimetype);
    }
}
