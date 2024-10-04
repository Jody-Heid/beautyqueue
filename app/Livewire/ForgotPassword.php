<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Password;
use Livewire\Component;

class ForgotPassword extends Component
{
    public $email;

    protected $rules = [
        'email' => 'required|email',
    ];

    public function sendResetLink()
    {
        $this->validate();

        $status = Password::sendResetLink(['email' => $this->email]);

        if ($status === Password::RESET_LINK_SENT) {
            session()->flash('status', __($status));
            $this->email = '';
        } else {
            $this->addError('error', __($status));
        }
    }

    public function render()
    {
        return view('livewire.forgot-password');
    }
}
