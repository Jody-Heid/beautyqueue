<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Admin;
use App\Models\Appointment;
use App\Models\Customer;
use App\Models\Hairstylist;
use App\Models\OfferedService;
use App\Models\User;
use App\Policies\AdminPolicy;
use App\Policies\AppointmentPolicy;
use App\Policies\CustomerPolicy;
use App\Policies\HairstylistPolicy;
use App\Policies\ServicePolicy;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        User::class => UserPolicy::class,
        OfferedService::class => ServicePolicy::class,
        Appointment::class => AppointmentPolicy::class,
        Admin::class => AdminPolicy::class,
        Hairstylist::class => HairstylistPolicy::class,
        Customer::class => CustomerPolicy::class,

    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
