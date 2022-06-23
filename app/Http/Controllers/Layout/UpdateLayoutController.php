<?php

namespace App\Http\Controllers\Layout;

use App\Http\Controllers\Controller;
use App\Http\Requests\Layouts\UpdateLayoutRequest;
use App\Models\Layout;

class UpdateLayoutController extends Controller
{
    public function __invoke(UpdateLayoutRequest $request, Layout $layout) {
        $data = $request-> validated();
        $layout-> update($data);
        return $layout;
    }
}
