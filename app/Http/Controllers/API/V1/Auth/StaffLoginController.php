<?php

namespace App\Http\Controllers\API\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\StaffLoginRequest;
use App\Repositories\StaffRepository;
use Flugg\Responder\Contracts\Responder;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class StaffLoginController extends Controller
{
    public function __construct(
        private readonly StaffRepository $staffRepository,
        private readonly Responder $responder
    ) {
    }

    public function login(StaffLoginRequest $request): JsonResponse
    {
        $staff = $this->staffRepository->getStaffByEmail($request->validated('email'));

        if (Hash::check($request->validated('password'), $staffPassword = $staff->password)) {
            $staff->tokens()->delete();

            return $this->responder
                ->success([
                    'token' => $staff->createToken($staffPassword)->plainTextToken,
                    'type' => 'bearer',
                ])
                ->respond();
        }

        return responder()
            ->error('unauthenticated')
            ->respond(403);
    }
}
