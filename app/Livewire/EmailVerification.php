<?php

namespace App\Livewire;

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Livewire\Component;

class EmailVerification extends Component
{
    public function resend()
    {
        auth()->user()->sendEmailVerificationNotification();

        session()->flash('resent', true);
    }

    public function verify(EmailVerificationRequest $request)
    {
        $request->fulfill();

        //TODO: add dashboard here
        return true;
    }

    public function render()
    {
        return view('livewire.email-verification');
    }
}
