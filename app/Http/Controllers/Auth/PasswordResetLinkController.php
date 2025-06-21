<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use App\Mail\VerifyResetCodeMail;
use Illuminate\Support\Facades\Mail;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/ForgotPassword', [
            'status' => session('status'),
        ]);
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        if ($status === Password::RESET_LINK_SENT) {
            $verifyCode = rand(100000, 999999); // کد ۶ رقمی
            DB::table('password_reset_tokens')
                ->where('email', $request->email)
                ->update([
                    'verify_code' => $verifyCode,
                    'verify_expires_at' => Carbon::now()->addMinutes(10)
                ]);


            Mail::to($request->email)->send(new VerifyResetCodeMail($verifyCode));

            return back()->with('status', 'کد تأیید به ایمیل شما ارسال شد.');
        }

        return back()->withErrors(['email' => __($status)]);
    }
}
