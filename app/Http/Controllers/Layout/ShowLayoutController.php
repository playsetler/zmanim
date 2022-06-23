<?php

namespace App\Http\Controllers\Layout;

use App\Http\Controllers\Controller;
use App\Models\Layout;

class ShowLayoutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function get(Layout $layout) {
        return view('preview', ['layout' => $layout]);
    }
}