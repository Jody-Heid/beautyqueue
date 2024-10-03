<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Services\CustomerService;
use Spatie\Permission\Models\Role;

class Register extends Component
{
    public $name;
    public $email;
    public $password;
    public $password_confirmation;

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed',
    ];

    public function submit()
    {
        $this->validate();

        $customerService = app(CustomerService::class);
        $customer = $customerService->createCustomer([
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
        ]);
        
        $customer->assignRole(Role::findByName('customer', 'web'));

        Auth::login($customer);

        return redirect()->route('dashboard');
    }

    public function render()
    {
        return view('livewire.register');
    }
}
