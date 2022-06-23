<?php

namespace App\Http\Controllers\Media;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Media;

class UploadFileController extends Controller
{
    public function __invoke(Request $request) {
        $path = $request-> file('file')-> store('upload/' . $request-> mediaType, 'public');
        //$path = Storage::putFile('upload/' . $request-> mediaType, $request-> file('file'), 'public');
        $media = Media::create(
            array(
                'title' => $request-> mediaType . mt_rand(100000000, 999999999),
                'type' => $request-> mediaType,
                'path' => Storage::path($path),
                'url' => Storage::url($path)
            )
        );
        return $media;
    }
}
