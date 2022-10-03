<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogsController extends Controller
{
    public function index()
    {
        $posts = [
            [
                'id' => 5,
                'title' => 'bar'
            ],
            [
                'id' => 7,
                'title' => 'foo'
            ]
        ];
        return array_reverse($posts);
    }
}
