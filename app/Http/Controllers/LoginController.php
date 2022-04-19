<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function showViewLogin()
    {
        return view('login.login');
    }


    public function login(Request $request)
    {

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('user.listUser')->with('success', 'Đăng nhập thành công');
        }
        return back()->withErrors([
            'email' => 'Email chưa chính xác',
            'password' => 'Mật khẩu chưa chính xác'
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
