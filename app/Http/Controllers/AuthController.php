<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{


    public function showFormLogin()
    {
        return view('auth.login');
    }
    public function login(Request $request)
    {
        $data = $request->validate([
           'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        if (Auth::attempt($data)) {
            return redirect()->intended('/home');
        }

        return redirect()->back()->withErrors(
            [
                'email' => 'email sai định dạng'
            ]
        )->onlyInput('email');
    }

    public function showFormRegister()
    {
        return view('auth.register');
    }



    public function register(Request $request)
    {
        // dd($request->all());
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8'],
        ]);
//   dd($data);
        // Tạo người dùng mới với dữ liệu đã xác thực
        $user = User::query()->create($data);
        // dd($user);
        // Đăng nhập người dùng mới tạo
        Auth::login($user);

        // Tái tạo session cho an toàn
        request()->session()->regenerate();

        // Chuyển hướng đến trang chủ
        return redirect()->intended('/home');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerate();
        return redirect('auth/showLogin');
    }
}
