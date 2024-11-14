<?php

namespace App\Http\Controllers\API\V1\Auth;

use App\Enums\UserRoles;
use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerRegistrationRequest;
use App\Repositories\UserRepository;
use App\Transformers\UserTransformer;
use Flugg\Responder\Contracts\Responder;
use Illuminate\Http\JsonResponse;

class CustomerRegistrationController extends Controller
{
    public function __construct(
        private readonly UserRepository $userRepository,
        private readonly Responder $responder
    ) {
    }

    public function register(CustomerRegistrationRequest $request): JsonResponse
    {
        $user = $this->userRepository->createUser($request->validated());

        //TODO: notify user of their registeration

        $user->assignRole(UserRoles::CUSTOMER);

        $user->syncPermissions(['view_customer']);

        return $this->responder
            ->success($user, UserTransformer::class)->respond();
    }
}
