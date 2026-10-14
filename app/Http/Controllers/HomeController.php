<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Rooms;
class HomeController extends Controller
{
    //
   public function index()
{
    $rooms = Rooms::with('facilities')->get();

    return Inertia::render('home', [
        'rooms' => $rooms
    ]);
}
}
