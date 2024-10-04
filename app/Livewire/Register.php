<?php

namespace App\Livewire;

use App\Services\CustomerService;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class Register extends Component
{
    public $name;

    public $email;

    public $password;

    public $password_confirmation;

    public $error = '';

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed',
    ];

    public function submit()
    {
        $this->error = '';
        $this->validate();

        $customerService = app(CustomerService::class);

        $customer = $customerService->createCustomer([
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
        ]);

        $customer->assignRole(Role::findByName('customer', 'web'));

        event(new Registered($customer));

        Auth::login($customer);

        return redirect()->route('verification.notice');
    }

    public function render()
    {
        return view('livewire.register');
    }
}
