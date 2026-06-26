<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    /**
     * Maximum login attempts before lockout.
     */
    protected int $maxAttempts = 5;

    /**
     * Lockout duration in seconds (5 minutes).
     */
    protected int $decaySeconds = 300;

    /**
     * Show the application login form.
     */
    public function show()
    {
        return view('auth.login');
    }

    /**
     * Get the rate limiter key for this request.
     */
    protected function throttleKey(Request $request): string
    {
        return Str::lower($request->input('login_id')) . '|' . $request->ip();
    }

    /**
     * Handle an incoming authentication request.
     */
    public function authenticate(Request $request)
    {
        $request->validate([
            'login_id' => ['required', 'string'],
            'password' => ['required'],
        ]);

        $throttleKey = $this->throttleKey($request);

        // Check if already locked out
        if (RateLimiter::tooManyAttempts($throttleKey, $this->maxAttempts)) {
            $seconds = RateLimiter::availableIn($throttleKey);
            $minutes = ceil($seconds / 60);

            return back()->withErrors([
                'email' => "Terlalu banyak percobaan login. Silakan coba lagi dalam {$minutes} menit.",
            ])->with('lockout_seconds', $seconds)->onlyInput('login_id');
        }

        $loginField = filter_var($request->login_id, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        // Check if user exists and is active
        $user = User::where($loginField, $request->login_id)->first();

        if ($user && !$user->is_active) {
            return back()->withErrors([
                'login_id' => 'Akun kasir/user dinonaktifkan.',
            ])->onlyInput('login_id');
        }

        if (Auth::attempt([$loginField => $request->login_id, 'password' => $request->password], $request->boolean('remember'))) {
            // Login berhasil — reset rate limiter
            RateLimiter::clear($throttleKey);
            $request->session()->regenerate();

            return redirect()->intended('/dashboard');
        }

        // Login gagal — tambah hit pada rate limiter
        RateLimiter::hit($throttleKey, $this->decaySeconds);

        return back()->withErrors([
            'login_id' => 'Informasi akun tidak ditemukan dalam sistem kami.',
        ])->onlyInput('login_id');
    }

    /**
     * Log the user out of the application.
     */
    public function destroy(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
