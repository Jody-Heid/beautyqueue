<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{
    public $email = '';

    public $password = '';

    public $rememberMe = false;

    public $authError = '';

    protected $rules = [
        'email' => ['required', 'email'],
        'password' => ['required'],
    ];

    public function render()
    {
        return view('livewire.login');
    }

    public function submit()
    {
        $this->authError = '';
        $this->validate();

        if ($this->attemptLogin()) {
            session()->regenerate();

            //TODO: add dashboard redirect here
            return true;
        }

        $this->authError = 'The provided credentials do not match our records.';
    }

    protected function attemptLogin()
    {
        return Auth::guard('web')->attempt([
            'email' => $this->email,
            'password' => $this->password,
        ], $this->rememberMe);
    }
}
