<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerCreateRequest;
use App\Http\Requests\CustomerUpdateRequest;
use App\Models\Customer;
use App\Services\CustomerService;
use App\Transformers\CustomerTransformer;
use Flugg\Responder\Responder;
use Spatie\Permission\Models\Role;

class CustomerController extends Controller
{
    public function __construct(
        private readonly CustomerService $customerService,
        private readonly Responder $responder,
    ) {
        $this->authorizeResource(Customer::class, 'customer');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = $this->customerService->listCustomers();

        return $customers->isEmpty()
            ? $this->responder->success($customers)->meta(['message' => 'No Customers Found'])->respond()
            : $this->responder->success($customers, CustomerTransformer::class)->respond();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CustomerCreateRequest $request)
    {
        $customer = $this->customerService->createCustomer($request->validated());
        $customer->assignRole(Role::findByName('customer', 'api'));

        return $this->responder->success($customer, CustomerTransformer::class)->meta(['message' => 'Customer Created'])->respond();
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        return $this->responder->success($customer, CustomerTransformer::class)->respond();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CustomerUpdateRequest $request, Customer $customer)
    {
        $customer = $this->customerService->updateCustomer($request->validated(), $customer);

        return $this->responder->success($customer, CustomerTransformer::class)->meta(['message' => 'Customer Updated'])->respond();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        $this->customerService->destroyCustomer($customer);

        return $this->responder->success()->meta(['message' => 'Customer Deleted'])->respond();
    }
}
