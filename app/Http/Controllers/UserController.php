<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        return view('login', ['title' => 'login']);
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ], [
            'email.required' => 'Email is required',
            'password.required' => 'Password is required'
        ]);

        $infologin = [
            'email' => $request->email,
            'password' => $request->password,
        ];


        if (Auth::attempt($infologin)) {
            if (Auth::user()->role == 'regular') {
                return view('regular.dashboard-reg');
            } else if (Auth::user()->role == 'agent') {
                return view('agent.dashboard-agent');
            } else if (Auth::user()->role == 'admin') {
                return redirect('/admin');
            }
        } else {
            return redirect('')->withErrors('Username atau Password yang dimasukan salah')->withInput();
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect("/login");
    }
}
