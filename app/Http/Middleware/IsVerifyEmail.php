<?php

namespace App\Http\Middleware;

use App\Models\adminVerify;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class IsVerifyEmail
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::guard('admin')->user()->is_email_verified == 0) {
            $admin_id = Auth::guard('admin')->user()->id;
            $admin_email = Auth::guard('admin')->user()->email;
            auth()->logout();
            $token = Str::random(64);
            adminVerify::create([
                'admin_id' => $admin_id,
                'token' => $token
            ]);
            $dataMail = ['token' => $token];
            Mail::send('Admin.Emails.emailVerificationEmail', $dataMail , function($message) use($admin_email){
                $message->to($admin_email);
                $message->subject('Email Verification Mail');
            });
            return redirect()->route('getLogin')
            ->with('message', 'You need to confirm your account. We have sent you an activation code, please check your email.');
        }
        return $next($request);
    }
}
