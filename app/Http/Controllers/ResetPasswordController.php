<?php

namespace App\Http\Controllers;

use App\Helper\EmailSender;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ResetPasswordController extends Controller
{
    public function showLinkRequestForm()
    {
        return view('auth.passwords.forget-password');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->with('message', 'ایمیل یافت نشد !');
        }

        $token = Str::random(64); // Generate a random token
        $user->update(['password_reset_token' => $token]);
        $link = "http://devpulse.ir/password/reset/$token";

        // return response()->json([
        //     'token'  => $token,
        //     'link' => "http://127.0.0.1:8000/password/reset/$token"
        // ]);

        try {

            $emailBody = view('email.password_reset', [
                "token" => $token,
                "reset_url"  => $link,
                "date"  => now(),
            ])->render();

            $emailSent = EmailSender::sendEmail($user->email, 'Reset Password', $emailBody);

            if ($emailSent) {
                return redirect("/password/forgot")->with([
                    'success' => true,
                    'message' => 'کد با موفقیت ارسال شد.',
                ]);
            } else {
                throw new \Exception('Email sending failed');
            }
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect("/password/forgot")->with([
                'success' => false,
                'message' => 'اطلاعات وارد شده معتبر نیست.',
                'errors'  => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            return redirect("/password/forgot")->with([
                'success' => false,
                'message' => 'خطایی رخ داده است. لطفا دوباره تلاش کنید.',
            ], 500);
        }
    }

    public function showRestPasswordForm($token)
    {
        return view('auth.passwords.reset-password');
    }
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token'    => 'required',
            'email'    => 'required|email',
            'password' => 'required|confirmed|min:8',
        ]);

        $user = User::where('email', $request->email)->where('password_reset_token', $request->token)->first();

        if (!$user) {
            return back()->with('message', 'توکن نامعتبر است !');
        }

        $user->update([
            'password'             => bcrypt($request->password),
            'password_reset_token' => null, // Remove the token after reset
        ]);

        return redirect('/login')->with('message', 'رمز عبور شما با موفقیت بازیابی گردید !');
    }
}