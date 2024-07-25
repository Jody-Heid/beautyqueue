<?php

namespace App\Interface;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Collection;

interface CustomerRepositoryInterface
{
    /**
     * Gets all Customer.
     */
    public function getAllCustomers(): Collection;

    /**
     * Retrieve an Customer model instance by id.
     */
    public function getCustomerById(int|string $id): Customer;

    /**
     * Retrieve an Customer model instance by email.
     */
    public function getCustomerByEmail(string $email): Customer;

    /**
     * Retrieve an Customer model instance by cellphone number.
     */
    public function getCustomerByCellphoneNumber(string $cellphoneNumber): Customer;

    /**
     * Create a new Customer.
     */
    public function createCustomer(array $customerDetails): Customer;

    /**
     * Update an existing Customer.
     */
    public function updateCustomer(array $newDetails, Customer $customer): Customer;

    /**
     * Remove an existing Customer.
     */
    public function deleteCustomer(Customer $customer): void;
}
