<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Jika login berhasil, redirect ke halaman yang sesuai
            return redirect()->intended('admin/dashboard');
        }

        // Jika login gagal, kembalikan ke halaman login dengan pesan kesalahan
        return back()->withInput()->withErrors(['email' => 'These credentials do not match our records.']);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        return redirect('/');
    }

    public function showRegistrationForm()
{
    return view('auth.register');
}

public function register(Request $request)
{
    // Validasi data yang masuk
    $this->validate($request, [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed',
    ]);

    // Buat pengguna baru dan simpan ke dalam database
    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password),
    ]);

    // Autentikasi pengguna setelah pendaftaran
    Auth::login($user);

    // Redirect ke halaman yang sesuai setelah registrasi
    return redirect()->intended('home');
}

}
