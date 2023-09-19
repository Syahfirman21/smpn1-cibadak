<?php 

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    // Menampilkan form login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Menampilkan form register
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // Proses login
    public function login(Request $request)
    {
        // Proses validasi login
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            // Jika berhasil, redirect ke halaman yang sesuai
            return redirect()->intended('/dashboard');
        }

        // Jika gagal, redirect kembali ke form login dengan pesan error
        return redirect()->route('login')->with('error', 'Login failed. Please check your credentials.');
    }

    // Proses register
    public function register(Request $request)
    {
        // Proses validasi register
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users|max:255',
            'password' => 'required|string|min:8',
        ]);

        // Simpan user baru ke database
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
        ]);

        // Autentikasi user setelah registrasi
        Auth::login($user);

        // Redirect ke halaman yang sesuai
        return redirect()->intended('/dashboard');
    }
}
