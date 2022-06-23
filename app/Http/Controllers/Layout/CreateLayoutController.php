<?php

namespace App\Http\Controllers\Layout;

use App\Http\Controllers\Controller;
use App\Http\Requests\Layouts\CreateLayoutRequest;
use App\Models\Layout;

class CreateLayoutController extends Controller
{
    public function __invoke(CreateLayoutRequest $request) {
        $data = $request-> validated();
        $layout = Layout::create($data);
        return $layout;
    }
}
