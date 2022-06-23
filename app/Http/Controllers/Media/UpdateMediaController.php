<?php

namespace App\Http\Controllers\Media;

use App\Http\Controllers\Controller;
use App\Http\Requests\Media\UpdateMediaRequest;
use App\Models\Media;

class UpdateMediaController extends Controller
{
    public function __invoke(UpdateMediaRequest $request, Media $media) {
        $data = $request-> validated();
        $media-> update($data);
        return $media;
    }
}
