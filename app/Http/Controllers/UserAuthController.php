<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserAuthController extends Controller
{
    /**
     * Show user login form
     */
    public function showLoginForm()
    {
        // If already logged in, redirect to gallery
        if (Auth::check()) {
            return redirect()->route('gallery.index');
        }
        
        return view('auth.user-login');
    }
    
    /**
     * Show user register form
     */
    public function showRegisterForm()
    {
        // If already logged in, redirect to gallery
        if (Auth::check()) {
            return redirect()->route('gallery.index');
        }
        
        return view('auth.user-register');
    }
    
    /**
     * Handle user login
     */
    public function login(Request $request)
    {
        // Rate limiting: max 5 attempts per minute
        $key = 'login_attempts_' . $request->ip();
        $maxAttempts = 5;
        $decayMinutes = 1;
        
        if (\Cache::has($key) && \Cache::get($key) >= $maxAttempts) {
            return back()
                ->withErrors(['email' => 'Terlalu banyak percobaan login. Silakan coba lagi dalam 1 menit.'])
                ->withInput($request->only('email'));
        }
        
        // Validate reCAPTCHA (disabled for now)
        // $recaptchaResponse = $request->input('g-recaptcha-response');
        // if (empty($recaptchaResponse)) {
        //     return back()
        //         ->withErrors(['email' => 'Silakan verifikasi bahwa Anda bukan robot'])
        //         ->withInput($request->only('email', 'remember'));
        // }
        
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ], [
            'email.required' => 'Email harus diisi',
            'email.email' => 'Format email tidak valid',
            'password.required' => 'Password harus diisi',
            'password.min' => 'Password minimal 6 karakter',
        ]);
        
        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput($request->only('email', 'remember'));
        }
        
        // Sanitize input
        $email = filter_var($request->email, FILTER_SANITIZE_EMAIL);
        $credentials = [
            'email' => $email,
            'password' => $request->password
        ];
        $remember = $request->has('remember');
        
        if (Auth::attempt($credentials, $remember)) {
            // Clear login attempts on successful login
            \Cache::forget($key);
            
            // Regenerate session to prevent session fixation
            $request->session()->regenerate();
            
            // Log successful login
            \Log::info('User logged in', ['user_id' => Auth::id(), 'email' => $email, 'ip' => $request->ip()]);
            
            // Check if user is admin, redirect to dashboard
            if (Auth::user()->isAdmin()) {
                return redirect()->intended('/dashboard');
            }
            
            // Regular user, redirect to gallery
            return redirect()->intended(route('gallery.index'))
                ->with('success', 'Login berhasil! Selamat datang ' . Auth::user()->name);
        }
        
        // Increment login attempts
        $attempts = \Cache::get($key, 0) + 1;
        \Cache::put($key, $attempts, now()->addMinutes($decayMinutes));
        
        // Log failed login attempt
        \Log::warning('Failed login attempt', ['email' => $email, 'ip' => $request->ip()]);
        
        return back()
            ->withErrors(['email' => 'Email atau password salah'])
            ->withInput($request->only('email', 'remember'));
    }
    
    /**
     * Handle user registration
     */
    public function register(Request $request)
    {
        // Rate limiting for registration
        $key = 'register_attempts_' . $request->ip();
        $maxAttempts = 3;
        $decayMinutes = 5;
        
        if (\Cache::has($key) && \Cache::get($key) >= $maxAttempts) {
            return back()
                ->withErrors(['email' => 'Terlalu banyak percobaan registrasi. Silakan coba lagi dalam 5 menit.'])
                ->withInput($request->only('name', 'email'));
        }
        
        // Validate reCAPTCHA (disabled for now)
        // $recaptchaResponse = $request->input('g-recaptcha-response');
        // if (empty($recaptchaResponse)) {
        //     return back()
        //         ->withErrors(['email' => 'Silakan verifikasi bahwa Anda bukan robot'])
        //         ->withInput($request->only('name', 'email'));
        // }
        
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'terms' => 'required|accepted',
        ], [
            'name.required' => 'Nama harus diisi',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'password.required' => 'Password harus diisi',
            'password.min' => 'Password minimal 6 karakter',
            'password.confirmed' => 'Konfirmasi password tidak cocok',
            'terms.required' => 'Anda harus menyetujui syarat dan ketentuan',
            'terms.accepted' => 'Anda harus menyetujui syarat dan ketentuan',
        ]);
        
        if ($validator->fails()) {
            // Increment registration attempts
            $attempts = \Cache::get($key, 0) + 1;
            \Cache::put($key, $attempts, now()->addMinutes($decayMinutes));
            
            return back()
                ->withErrors($validator)
                ->withInput($request->only('name', 'email'));
        }
        
        try {
            // Sanitize input
            $name = strip_tags($request->name);
            $email = filter_var($request->email, FILTER_SANITIZE_EMAIL);
            
            // Generate username from email
            $username = explode('@', $email)[0];
            
            // Create new user
            $user = User::create([
                'name' => $name,
                'username' => $username,
                'email' => $email,
                'password' => Hash::make($request->password),
                'role' => 'user', // Regular user, not admin
            ]);
            
            // Clear registration attempts
            \Cache::forget($key);
            
            // Log successful registration
            \Log::info('New user registered', ['user_id' => $user->id, 'email' => $email, 'ip' => $request->ip()]);
            
            // Auto login after registration
            Auth::login($user);
            
            // Regenerate session
            $request->session()->regenerate();
            
            return redirect()->route('gallery.index')
                ->with('success', 'Pendaftaran berhasil! Selamat datang ' . $user->name);
                
        } catch (\Exception $e) {
            \Log::error('Registration error: ' . $e->getMessage(), [
                'email' => $request->email,
                'ip' => $request->ip(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return back()
                ->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()])
                ->withInput($request->only('name', 'email'));
        }
    }
    
    /**
     * Handle user logout
     */
    public function logout(Request $request)
    {
        Auth::logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('gallery.index')
            ->with('success', 'Anda telah logout');
    }
}
