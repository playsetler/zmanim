<?php

namespace App\Http\Controllers\Layout;

use App\Http\Controllers\Controller;
use App\Models\Layout;
use Illuminate\Http\Request;

class DeleteLayoutsController extends Controller
{
    public function __invoke(Request $request) {
        $data = $request->all();
        if(gettype($data) == 'array') {
            Layout::destroy($data);
        }
        
        return response($data);
    }
}
