<?php

namespace App\Http\Controllers;

class IndexController extends Controller
{
    public function index(): \Inertia\Response
    {
        return inertia('Index');
    }
}
