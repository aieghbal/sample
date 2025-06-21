<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Password;

class VerifyResetCodeController extends Controller
{
    public function showForm()
    {
        return view('auth.verify-reset-code');
    }

    public function verify(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'verify_code' => 'required|digits:6',
        ]);

        $record = DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->where('verify_code', $request->verify_code)
            ->where('verify_expires_at', '>', now())
            ->first();

        if (!$record) {
            return back()->withErrors(['verify_code' => 'کد وارد شده اشتباه یا منقضی است.']);
        }

        return redirect()->route('password.reset', [
            'token' => $record->token,
            'email' => $request->email,
        ]);
    }
}

