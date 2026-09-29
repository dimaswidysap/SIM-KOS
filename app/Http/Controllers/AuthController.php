<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth; // 1. Import Auth Facade
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        // Hapus token lama jika ingin membatasi 1 sesi aktif per device (opsional)
        $user->tokens()->delete();

        $deviceName = $request->device_name ?? 'default-device';
        $token = $user->createToken($deviceName)->plainTextToken;

        // 2. Buat Session Web agar middleware ['auth'] mengizinkan akses ke /dashboard
        Auth::login($user);

        // Sembunyikan atribut sensitif/tidak perlu
        $user->makeHidden(['email_verified_at', 'created_at', 'updated_at', 'deleted_at']);

        return response()->json([
            'status' => 'success',
            'message' => 'Login successful',
            'data' => [
                'user' => $user,
                'token' => $token,
            ],
        ]);
    }

    public function tes()
    {
        return 'tesss';
    }
}
