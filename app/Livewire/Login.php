<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

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
            //TODO: add dashboard view
            return $this->redirect(route('dashboard'), navigate: true);
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
