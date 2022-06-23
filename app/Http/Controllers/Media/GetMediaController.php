<?php

namespace App\Http\Controllers\Media;

use App\Http\Controllers\Controller;
use App\Models\Media;
use Illuminate\Http\Request;

class GetMediaController extends Controller
{
    public function __invoke(Request $request) {
        $media = Media::where('type', $request-> type)-> get();
        return $media;
    }
}
