<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        if ($request->getMethod() == 'GET') {
            return view('user.auth.login');
        }
        $request->validate([
            'phone' => 'required',
            'password' => 'required'
        ]);
        $credentials = $request->only(['phone', 'password']);
        if (Auth::attempt($credentials)) {
            return redirect()->route('home');
        } else {
            return redirect()->back()->withInput()->withErrors(([
                'approve' => 'Số điện thoại hoặc mật khẩu sai'
            ]));
        }
    }

    public function register(Request $request)
    {
        if($request->getMethod() == 'GET') {
            return view('user.auth.register');
        }
        $credentials = $request->only(['name', 'phone', 'password']);
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:10|min:10|unique:users',
            'password' => 'required|min:6',
        ]);
        User::create([
            'name' => $request->input('name'),
            'phone' => $request->input('phone'),
            'password' => Hash::make($request->input('password')),
            'point' => 0,
        ]);
        $data=([
            'general_message' => 'Tạo tài khoản thành công.',
            'general_message_type' => 'success',
        ]);
        return view('user.auth.login', $data);
    }

    public function logout(Request $request){
        Auth::logout();
 
        $request->session()->invalidate();
        $request->session()->regenerateToken();
 
        return redirect()->route('home');
    }
}
