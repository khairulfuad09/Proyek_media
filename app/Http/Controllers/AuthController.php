<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'nis' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        
        $user = \App\Models\User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'nis' => $validatedData['nis'],
            'password' => bcrypt($validatedData['password']),
            'role' => 'unknown', // Set role default sebagai unknown
        ]);

        // Redirect atau kembalikan response sesuai kebutuhan
        return redirect()->route('home')->with('success', 'Registrasi berhasil! Silakan masuk.');
    }
    public function login(Request $request)
    {
        // Validasi input
       $request->validate([
            'nis' => 'required',
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('nis', 'email', 'password');

        // Coba login dengan kredensial yang diberikan
        if (auth::attempt($credentials)) {
            // Login berhasil, arahkan ke halaman yang sesuai

            $request->session()->regenerate();

            $user = auth::user();

            if ($user->role === 'admin') {
                return redirect()->route('adminDanGuru.dashboard');
            } elseif ($user->role === 'guru') {
                return redirect()->route('adminDanGuru.dashboard');
            } elseif ($user->role === 'siswa') {
                return redirect()->route('progress.siswa');
            }elseif ($user->role === 'unknown') {
                return redirect()->route('waiting');
            }else {
                return redirect()->route('home')->with('error', 'Role pengguna tidak dikenali. Silakan hubungi administrator.');
            }
        }

        // Login gagal, kembalikan error
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }
    // LOGOUT
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
