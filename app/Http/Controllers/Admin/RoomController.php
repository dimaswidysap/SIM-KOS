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
            'room_price' => ['required', 'numeric', 'min:550000'],
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
    // Load relasi facilities agar datanya terikut ke dalam $room
    $room->load('facilities');

    return Inertia::render('admin/rooms/roomsDetail', [
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

   public function roomsPageEdit(Rooms $room): Response
    {
        // Load relasi fasilitas agar checkbox otomatis tercentang sesuai data terdahulu
        $room->load('facilities');
        $facilities = Facilities::all();

        return Inertia::render('admin/rooms/roomEdit', [
            'room' => $room,
            'facilities' => $facilities,
        ]);
    }

    public function roomUpdate(Request $request, Rooms $room)
    {
        $validated = $request->validate([
            'room_no' => 'required|string|unique:rooms,no_room,' . $room->id,
            'room_floor' => 'required|numeric',
            'room_price' => 'required|numeric',
            'room_status' => 'required|string',
            'facilities' => 'nullable|array',
            'facilities.*' => 'exists:facilities,id',
        ]);

        $room->update([
            'no_room' => $validated['room_no'],
            'floor' => $validated['room_floor'],
            'price' => $validated['room_price'],
            'status_room' => $validated['room_status'],
        ]);

        // Format data pivot untuk mengisi kolom status di tabel room_amenities
        $syncData = collect($request->facilities)->mapWithKeys(function ($facilityId) {
            return [$facilityId => ['status' => 'aktif']];
        })->toArray();

        // Sinkronisasi data relasi fasilitas kamar
        $room->facilities()->sync($syncData);

        return redirect()->route('rooms.page.edit', $room->id)->with('success', 'Data kamar berhasil diperbarui');
    }


}
