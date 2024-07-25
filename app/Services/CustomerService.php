<?php

namespace App\Services;

use App\Interface\CustomerRepositoryInterface;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Collection;

class CustomerService
{
    public function __construct(
        private readonly CustomerRepositoryInterface $customerRepositoryInterface,
    ) {
    }

    /**
     * List all Customer.
     */
    public function listCustomers(): Collection
    {
        return $this->customerRepositoryInterface->getAllCustomers();
    }

    /**
     * Create a new Customer and assign a role.
     */
    public function createCustomer(array $customerData): Customer
    {
        return $this->customerRepositoryInterface->createCustomer($customerData);
    }

    /**
     * Get a specific Customer by ID.
     */
    public function getCustomerById(string|int $id): Customer
    {
        return $this->customerRepositoryInterface->getCustomerById($id);
    }

    /**
     * Update an existing Customer and sync their roles.
     */
    public function updateCustomer(array $customerData, Customer $customer): Customer
    {
        $this->customerRepositoryInterface->updateCustomer($customerData, $customer);

        return $customer;
    }

    /**
     * Delete a specific Customer.
     */
    public function destroyCustomer(Customer $customer): void
    {
        $this->customerRepositoryInterface->deleteCustomer($customer);

    }
}
