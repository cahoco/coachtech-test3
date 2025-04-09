<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterStep1Request;
use App\Http\Requests\RegisterStep2Request;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\WeightLog;
use App\Models\WeightTarget;

class AuthController extends Controller
{
    public function showRegisterStep1()
    {
        return view('auth.register_step1');
    }

    public function registerStep1(RegisterStep1Request $request)
    {
        $validated = $request->validated();
        session([
            'register.name' => $validated['name'],
            'register.email' => $validated['email'],
            'register.password' => Hash::make($validated['password']),
        ]);
        return redirect()->route('register.step2');
    }

    public function showRegisterStep2()
    {
        return view('auth.register_step2');
    }

    public function registerStep2(RegisterStep2Request $request)
    {
        $validated = $request->validated();
        $user = User::create([
            'name' => session('register.name'),
            'email' => session('register.email'),
            'password' => session('register.password'),
        ]);

        WeightTarget::create([
            'user_id' => $user->id,
            'target_weight' => $validated['target_weight'],
        ]);

        WeightLog::create([
            'user_id' => $user->id,
            'date' => now()->toDateString(),
            'weight' => $validated['initial_weight'],
        ]);

        Auth::login($user);
        session()->forget('register');

        return redirect('/weight_logs');
    }

    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/weight_logs');
        }
        return back()->withErrors([
            'email' => 'メールアドレスまたはパスワードが正しくありません。',
        ])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

}
