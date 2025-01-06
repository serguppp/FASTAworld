<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\File;
use Illuminate\Http\Request;

class DownloadsController extends Controller
{
    public function download($id) {
        $file = File::findOrFail($id);
        $file_path = storage_path('app/public/' . $file->file_path);
        return response()->download($file_path);
      }
}
