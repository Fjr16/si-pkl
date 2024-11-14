<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login', [
            'title' => 'Login',
        ]);
    }

    public function authenticate(Request $request)
    {
        Session::flash('username', $request->input('username'));
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $credentials = [
            'username' => $request->input('username'),
            'password' => $request->input('password'),
        ];

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        } else {
            return redirect()->back()->with('failed', 'Username atau password anda salah!!!');
        }
    }

    public function logout()
    {
        Auth::logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect()->route('login');
    }

    // public function forgotPassword()
    // {
    //     return view('auth.forgot-password', [
    //         'title' => 'Lupa Password',
    //     ]);
    // }

    // public function sendLink(Request $request)
    // {
    //     $request->validate(['email' => 'required|email']);

    //     $status = Password::sendResetLink(
    //         $request->only('email')
    //     );

    //     return $status === Password::RESET_LINK_SENT
    //         ? back()->with('success', 'Link Reset Password Berhasil Dikirim Ke Email Anda')
    //         : back()->with('failed', 'Kami Tidak Dapat Menemukan User Dengan Email Ini');
    // }

    // public function reseTPasswordToken($token)
    // {
    //     return view('auth.reset-password', [
    //         'title' => 'Reset Password',
    //         'token' => $token,
    //     ]);
    // }

    // public function resetPassword(Request $request)
    // {
    //     $request->validate([
    //         'token' => 'required',
    //         'email' => 'required|email',
    //         'password' => 'required|confirmed',
    //     ]);

    //     $status = Password::reset(
    //         $request->only('email', 'password', 'password_confirmation', 'token'),
    //         function ($user, $password) {
    //             $user->forceFill([
    //                 'password' => Hash::make($password)
    //             ])->setRememberToken(Str::random(60));

    //             $user->save();

    //             event(new PasswordReset($user));
    //         }
    //     );

    //     // dd($status);

    //     return $status === Password::PASSWORD_RESET
    //         ? redirect()->route('login.index')->with('success', 'Reset Password Berhasil, Silahkan Login')
    //         : back()->with('failed', 'Reset Password Gagal');
    // }
}
