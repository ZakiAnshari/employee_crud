<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
 
    public function login()
    {
        return view('login');
    }

    public function authenticating(Request $request)
    {
        // Validasi input email & password
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ], [
            'email.required' => 'Email harus diisi!',
            'email.email' => 'Format email tidak valid!',
            'password.required' => 'Password harus diisi!',
        ]);

        // Cari user berdasarkan email
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            toast('Email tidak ditemukan', 'error')
                ->position('top-end')
                ->autoClose(3000)
                ->width('fit-content');
            return back()->withInput();
        }

        // Cek password
        if (!Hash::check($request->password, $user->password)) {
            toast('Password salah', 'error')
                ->position('top-end')
                ->autoClose(3000)
                ->width('fit-content');
            return back()->withInput();
        }

        // Login user
        Auth::login($user);
        $request->session()->regenerate();

        alert()->success('Berhasil Login', 'Selamat datang di Okeev');

        // Redirect ke intended URL jika ada
        $intendedUrl = redirect()->intended()->getTargetUrl();
        if ($intendedUrl && !str_contains($intendedUrl, '/login')) {
            return redirect()->to($intendedUrl);
        }

        // Redirect berdasarkan role
        switch ($user->role_id) {
            case 2:
                return redirect('/home');

            case 1:
            default:
                return redirect('/dashboard');
        }
    }



    // LOGOUT ADMIN
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}