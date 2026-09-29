<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Notifications\SendTwoFactorCode;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Http\Controllers\Controller;

class TwoFactorController extends Controller
{
    public function index()
    {
        return view('auth.twoFactor');
    }

    public function store(Request $request): ValidationException|RedirectResponse
    {
        $request->validate([
            'two_factor_code' => ['integer', 'required'],
        ]);
        $user = auth()->user();

        // $user = User::find(session('user_id'));
        // $userId = session('user_id');

        // dd($userId);


        if ($request->input('two_factor_code') !== $user->two_factor_code) {
            throw ValidationException::withMessages([
                'two_factor_code' => __('You have entered invalid verification code'),
            ]);
        }
        $user->resetTwoFactorCode();

        if ($user->is_admin) {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->to('/');

    }

    public function resend(): RedirectResponse
    {
        $user = auth()->user();
        $user->generateTwoFactorCode();
        $user->notify(new SendTwoFactorCode());
        return redirect()->back()->withStatus(__('Code has been sent again'));
    }
}
