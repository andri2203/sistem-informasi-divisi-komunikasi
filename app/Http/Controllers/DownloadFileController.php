<?php

namespace App\Http\Controllers;

use App\Models\UploadFile;
use Illuminate\Support\Facades\Storage;

class DownloadFileController extends Controller
{
    public function index($id)
    {
        $file = UploadFile::find($id);

        if (!$file) {
            return back()->with('error', 'Maaf, File tidak ditemukan');
        }


       return Storage::download($file->file);
    }
}
