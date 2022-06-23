<?php

namespace App\Http\Controllers\Media;

use App\Http\Controllers\Controller;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DeleteMediaController extends Controller
{
    public function __invoke(Request $request) {
        $data = $request->all();
        if(gettype($data) == 'array') {
            foreach($data as $id) {
                $media = Media::find(strval($id));
                Storage::delete($media-> path);
                $media-> delete();
            }
        }
        
        return response($data);
    }
}
