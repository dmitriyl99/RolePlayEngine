<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class HelperController extends Controller
{
    const UPLOAD_DIRECTORY = 'storage/uploads/';

    public function uploadCkfinderImage(Request $request) {
        if ($request->file('upload')) {
            $image = $request->file('upload');
            $filename = Str::random(10) . '.' . $image->extension();
            $image->storeAs(self::UPLOAD_DIRECTORY, $filename);
            $url = asset(self::UPLOAD_DIRECTORY . $filename);
            return response()->json([ 'fileName' => $filename, 'uploaded' => true, 'url' => $url, ]);
        }
    }
}
