<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class PasswordController extends Controller
{
    /**
     * Update the user's password.
     */
    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validateWithBag('updatePassword', [
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed'],
            'password_confirmation' => ['required','same:password'],
        ],
        [
            'current_password.required'=>"Joriy parol maydonini to'ldirish majburiy",
            'password.required'=>"Ushbu parol maydonini to'ldirish majburiy",
            'password.confirmed'=>"Ushbu parol maydoni tasdiqlanmadi",
            'password_confirmation.required'=>"Ushbu parolni tasdiqlash maydonini to'ldirish majburiy",
            'password_confirmation.same'=>"Ushbu parolni tasdiqlash maydoni noto'g'ri kiritilgan",
            'current_password.current_password'=>"Joriy parol maydoni noto'g'ri"
        ]);

        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        return back()->with('status', 'password-updated');
    }
}
