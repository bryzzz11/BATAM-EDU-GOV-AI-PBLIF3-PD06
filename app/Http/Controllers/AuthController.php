<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rule;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    // ─────────────────────────────────────────────
    //  REGISTER (Email + Password)
    // ─────────────────────────────────────────────

    public function showRegister()
    {
        return view('auth', ['mode' => 'register']);
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', Password::min(8)],
        ]);

        $user = User::create([
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        Auth::login($user);

        return redirect()->route('dashboard')->with('success', 'Akun berhasil dibuat! Selamat datang.');
    }

    // ─────────────────────────────────────────────
    //  LOGIN (Email + Password)
    // ─────────────────────────────────────────────

    public function showLogin()
    {
        return view('auth', ['mode' => 'login']);
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);
        $credentials['role'] = 'pemohon';

        $remember = $request->boolean('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            return redirect()->intended(route('dashboard'))->with('success', 'Selamat datang kembali!');
        }

        return back()
            ->withInput($request->only('email'))
            ->withErrors(['email' => 'Email atau kata sandi tidak cocok.']);
    }

    public function showPegawaiLogin()
    {
        return view('pegawai.login');
    }

    public function pegawaiLogin(Request $request)
    {
        $validated = $request->validate([
            'identifier' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string'],
            'role' => ['required', Rule::in(['admin', 'verifikator', 'pimpinan'])],
        ]);

        $user = User::query()
            ->where('email', $validated['identifier'])
            ->orWhere('employee_id', $validated['identifier'])
            ->first();

        if (
            $user
            && $user->role === $validated['role']
            && $user->password
            && Hash::check($validated['password'], $user->password)
        ) {
            Auth::login($user, $request->boolean('remember'));
            $request->session()->regenerate();

            return redirect()->route('pegawai.dashboard')->with('success', 'Berhasil masuk ke panel pegawai.');
        }

        return back()
            ->withInput($request->only('identifier', 'role'))
            ->withErrors(['identifier' => 'Kredensial atau akses pegawai tidak cocok.']);
    }

    // ─────────────────────────────────────────────
    //  LOGOUT
    // ─────────────────────────────────────────────

    public function logout(Request $request)
    {
        $isPegawai = Auth::user()?->role !== 'pemohon';

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route($isPegawai ? 'pegawai.login' : 'login');
    }

    // ─────────────────────────────────────────────
    //  GOOGLE OAUTH
    // ─────────────────────────────────────────────

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
        } catch (\Exception $e) {
            return redirect()->route('login')->withErrors(['email' => 'Login Google gagal. Silakan coba lagi.']);
        }

        // Find or create user from Google data
        $user = User::updateOrCreate(
            ['google_id' => $googleUser->getId()],
            [
                'name'   => $googleUser->getName(),
                'email'  => $googleUser->getEmail(),
                'avatar' => $googleUser->getAvatar(),
                // password stays null for Google-only users
            ]
        );

        if ($user->role !== 'pemohon') {
            return redirect()->route('login')->withErrors(['email' => 'Akun pegawai tidak dapat masuk melalui Google.']);
        }

        Auth::login($user, true);

        return redirect()->route('dashboard')->with('success', 'Berhasil masuk dengan Google!');
    }
}
