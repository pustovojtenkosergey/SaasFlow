<?php

namespace App\Http\Controllers;

use App\Infrastructure\Helpers\FlowStorage;

class FlowController extends Controller
{

    public function index()
    {
        $list = FlowStorage::getAll();

        return view('flow', [
            'list' => $list
        ]);
    }
}
