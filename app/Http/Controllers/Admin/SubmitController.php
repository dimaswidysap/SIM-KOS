<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class SubmitController extends Controller
{
    //
    public function create(): Response
    {
        return Inertia::render('admin/submit');
    }

    public function store(){

    }
}
