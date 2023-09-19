<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User; // Anda perlu mengimpor model User

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
            return redirect()->intended('admin');
        }
    
        // Jika login gagal, kembali ke halaman login default dengan pesan kesalahan
        return redirect()->route('login')->withErrors(['password' => 'Identitas tersebut tidak cocok dengan data kami']);
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
    
        // Redirect ke halaman login setelah registrasi berhasil
        return redirect()->route('login');
        
        
        
    }
    
    
}
