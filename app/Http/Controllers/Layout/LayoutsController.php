<?php

namespace App\Http\Controllers\Layout;

use App\Http\Controllers\Controller;
use App\Models\Layout;
use Illuminate\Http\Request;

class LayoutsController extends Controller
{
    public function Get() {
        $layouts = Layout::all();
        return $layouts;
    }

    public function Delete(Layout $layout) {
        $layout-> delete();
        return response([]);
    }
}
