<?php

namespace App\Http\Controllers\Media;

use App\Http\Controllers\Controller;
use App\Http\Requests\Media\CreateMediaRequest;
use App\Models\Media;

class CreateMediaController extends Controller
{
    public function __invoke(CreateMediaRequest $request) {
        $data = $request-> validated();
        $media = Media::create($data);
        return $media;
    }
}
