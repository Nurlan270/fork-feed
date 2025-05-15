<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

class EmailVerificationController extends Controller
{
    public function verify(EmailVerificationRequest $request)
    {
        $request->fulfill();

        notyf()->success(__('flasher.email.success'));

        return redirect()->intended('welcome');
    }

    public function send(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();

        notyf()->success(__('flasher.email.sent'));

        return back();
    }
}
