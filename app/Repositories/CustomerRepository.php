<?php

namespace App\Repositories;

use App\Interface\CustomerRepositoryInterface;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Collection;

class CustomerRepository implements CustomerRepositoryInterface
{
    /**
     * Gets all Customer.
     */
    public function getAllCustomers(): Collection
    {
        return Customer::all();
    }

    /**
     * Retrieve an Customer model instance by id.
     */
    public function getCustomerById(int|string $id): Customer
    {
        return Customer::findOrFail($id);
    }

    /**
     * Retrieve an Customer model instance by email.
     */
    public function getCustomerByEmail(string $email): Customer
    {
        return Customer::where('email', $email)->first();
    }

    /**
     * Retrieve an Customer model instance by cellphone number.
     */
    public function getCustomerByCellphoneNumber(string $cellphoneNumber): Customer
    {
        return Customer::where('cellphone_numnber', $cellphoneNumber)->first();
    }

    /**
     * Create a new Customer.
     */
    public function createCustomer(array $customerDetails): Customer
    {
        return Customer::create($customerDetails);
    }

    /**
     * Update an existing Customer.
     */
    public function updateCustomer(array $newDetails, Customer $customer): Customer
    {
        $customer->update($newDetails);

        return $customer;
    }

    /**
     * Remove an existing Customer.
     */
    public function deleteCustomer(Customer $customer): void
    {
        $customer->delete();
    }
}
