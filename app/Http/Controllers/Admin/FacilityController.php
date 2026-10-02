<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\Facilities;

class FacilityController extends Controller
{
    //
    public function pageFacility(): Response
    {
        $facilities = Facilities::all();
        return Inertia::render('admin/facility', [
            'facilities' => $facilities,
        ]);
    }
    public function pageFormFacility(): Response
    {
        return Inertia::render('admin/facility/createFacility');
    }

    public function facilityStore(Request $request)
    {
        $request->validate([
            'facility_name' => ['required', 'string', 'min:3', 'max:255'],
        ]);

        Facilities::create([
            'facility_name' => $request->facility_name,
        ]);

        // Tambahkan redirect kembali ke halaman list
        return redirect()->back()->with('success', 'Fasilitas berhasil ditambahkan');
    }

    public function destroy(Facilities $facility)
    {
        // Hapus data dari database
        $facility->delete();

        // Redirect kembali dengan pesan sukses (akan otomatis ditangkap oleh Notification.vue)
        return redirect()->back()->with('success', 'Fasilitas berhasil dihapus');
    }
}
