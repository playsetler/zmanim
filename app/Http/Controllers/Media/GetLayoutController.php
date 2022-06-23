<?php

namespace App\Http\Controllers\Media;

use App\Http\Controllers\Controller;
use App\Models\Media;

class GetMediaController extends Controller
{
    public function __invoke(Media $media) {
        return $media;
    }
}
