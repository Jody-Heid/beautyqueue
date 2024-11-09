<?php

namespace App\Http\Controllers\API\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterCustomerRequest;
use App\Services\CustomerService;
use App\Transformers\CustomerTransformer;
use Flugg\Responder\Contracts\Responder;
use Illuminate\Http\JsonResponse;
use Spatie\Permission\Models\Role;

class RegisterController extends Controller
{
    public function __construct(
        private readonly CustomerService $customerService,
        private readonly Responder $responder
    ) {
    }

    public function register(RegisterCustomerRequest $request): JsonResponse
    {
        $customer = $this->customerService->createCustomer($request->validated());
        $customer->assignRole(Role::findByName('customer', 'api'));

        return $this->responder->success($customer, CustomerTransformer::class)->meta(['message' => 'Customer Created'])->respond();
    }
}
