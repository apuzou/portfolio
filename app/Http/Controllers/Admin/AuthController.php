<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminLoginRequest;
use App\SecurityLogger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.auth.login');
    }

    public function login(AdminLoginRequest $request)
    {
        $credentials = $request->validated();

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            // ログイン成功のログ
            SecurityLogger::logLoginSuccess(
                $credentials['email'],
                $request->ip(),
                $request->userAgent()
            );

            return redirect()->route('admin.dashboard');
        }

        // ログイン失敗のログ
        SecurityLogger::logLoginFailure(
            $credentials['email'],
            $request->ip(),
            $request->userAgent()
        );

        throw ValidationException::withMessages([
            'email' => '認証情報が正しくありません。',
        ]);
    }

    public function logout(Request $request)
    {
        $user = Auth::user();

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // ログアウトのログ
        if ($user) {
            SecurityLogger::logLogout($user->email, $request->ip());
        }

        return redirect()->route('admin.login');
    }
}
