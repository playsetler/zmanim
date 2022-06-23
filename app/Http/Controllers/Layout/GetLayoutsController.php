<?php

namespace App\Http\Controllers\Layout;

use App\Http\Controllers\Controller;
use App\Models\Layout;

class GetLayoutsController extends Controller
{
    public function __invoke() {
        $layouts = Layout::all();
        return $layouts;
    }
}
