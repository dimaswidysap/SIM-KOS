<?php

namespace App\Http\Controllers\Admin;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Validation\Rule;
use App\Models\Facilities;
use App\Models\Rooms;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    //
    public function pageRoom(): Response
    {
        $rooms = Rooms::all();

        return Inertia::render('admin/rooms/roomsView', ['rooms' => $rooms]);
    }

    public function pageCreateRoom(): Response
    {
        return Inertia::render('admin/rooms/createRoom');
    }

    public function roomsStore(Request $request)
    {
        $request->validate([
            'room_no' => ['required', 'string', 'max:255', Rule::unique('rooms', 'no_room')],
            'room_floor' => ['required', 'integer', 'max:3', 'min:1'],
            'room_price' => ['required', 'numeric', 'min:550'],
            'room_status' => ['required', 'string', Rule::in(['tersedia', 'tidak_tersedia', 'renovasi'])],
        ]);

        Rooms::create([
            'no_room' => $request->room_no,
            'floor' => $request->room_floor,
            'price' => $request->room_price,
            'status_room' => $request->room_status,
        ]);

        return redirect()->back()->with('success', 'Kamar berhasil dibuat');
    }

    public function pageDetailRoom(Rooms $room)
{
    return inertia::render('admin/rooms/roomsDetail', [
        'room' => $room,
    ]);
}

    public function roomsDestroy(Rooms $room)
    {
        // dd($room);

        // Hapus data dari database
        $room->delete();

        // Redirect kembali dengan pesan sukses (akan otomatis ditangkap oleh Notification.vue)
        return redirect()->back()->with('success', 'Kamar berhasil dihapus');
    }
}
