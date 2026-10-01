<?php

namespace App\Http\Controllers\Admin;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\Facilities;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    //
    public function pageRoom(): Response
    {
        return Inertia::render('admin/rooms/roomsView');
    }
}
