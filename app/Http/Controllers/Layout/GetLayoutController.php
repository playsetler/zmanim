<?php

namespace App\Http\Controllers\Layout;

use App\Http\Controllers\Controller;
use App\Models\Layout;

class GetLayoutController extends Controller
{
    public function __invoke(Layout $layout) {
        return $layout;
    }
}
