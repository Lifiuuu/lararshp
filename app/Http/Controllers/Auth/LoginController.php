<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\DataUser;
use App\Models\Role;


class LoginController extends Controller
{

    use AuthenticatesUsers;

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
{
    $validator = Validator::make($request->all(), [
        'email' => 'required|email',
        'password' => 'required|min:6',
    ]);

    if ($validator->fails()) {
        return redirect()->back()
            ->withErrors($validator)
            ->withInput();
    }

    $user = \App\Models\User::with(['roleUsers' => function ($query) {
        $query->where('status', '1');
    }, 'roleUsers.role'])
        ->where('email', $request->input('email'))
        ->first();

    if (!$user) {
        return redirect()->back()
            ->withErrors(['email' => 'Email tidak ditemukan.'])
            ->withInput();
    }

    // Cek password
    if (!Hash::check($request->password, $user->password)) {
        return redirect()->back()
            ->withErrors(['password' => 'Password salah.'])
            ->withInput();
    }

    // Login user ke session
    Auth::login($user);

    // Simpan session user
    $request->session()->put([
        'user_id' => $user->iduser,
        'user_name' => $user->nama,
        'user_email' => $user->email,
        'user_role' => $user->roleUsers[0]->idrole ?? 'user',
        'user_status' => $user->roleUsers[0]->status ?? 'active'
    ]);

    $userRole = $user->roleUsers[0]->idrole ?? null;

    switch ($userRole) {
        case 1:
            return redirect()->route('admin.dashboard')->with('success', 'Login Berhasil!');
            break;
        case 2:
            return redirect()->route('dokter.dashboard')->with('success', 'Login Berhasil!');
            break;
        case 3:
            return redirect()->route('perawat.dashboard')->with('success', 'Login Berhasil!');
            break;
        case 4:
            return redirect()->route('resepsionis.dashboard')->with('success', 'Login Berhasil!');
            break;
        case 5:
            return redirect()->route('pemilik.dashboard')->with('success', 'Login Berhasil!');
            break;
    }
}

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Logged out successfully');
    }
}
