<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('admin.auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nama_lengkap' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z\s]+$/'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', 'min:8', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/'],
            'password_confirmation' => ['same:password'],
        ], [
            'nama_lengkap.regex' => 'Nama hanya boleh mengandung huruf dan spasi!',
            'nama_lengkap.required' => 'Nama harus diisi!',
            'nama_lengkap.max' => 'Nama tidak boleh lebih dari 255 karakter!',
            'email.required' => 'Email harus diisi!',
            'email.email' => 'Format email tidak valid.',
            'email.max' => 'Tidak boleh lebih dari 255 karakter!',
            'email.unique' => 'Email sudah digunakan!',
            'password.required' => 'Password harus diisi!',
            'password.confirmed' => 'Password konfirmasi tidak cocok!',
            'password.min' => 'Password minimal 8 karakter!',
            'password.regex' => 'Password Harus mengandung huruf kapital, angka, dan simbol!',
            'password_confirmation' => 'Password konfirmasi tidak cocok!',
        ]);

        $user = User::create([
            'nama_lengkap' => $request->nama_lengkap,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        return redirect()->route('login')->with('Success', 'Registrasi berhasil');
    }
}
