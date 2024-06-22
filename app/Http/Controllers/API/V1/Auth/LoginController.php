<?php

namespace App\Http\Controllers\API\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Repositories\UserRepository;
use Flugg\Responder\Contracts\Responder;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function __construct(private readonly UserRepository $userRepository,
        private readonly Responder $responder
    ) {
    }

    public function authentication(LoginRequest $request): JsonResponse
    {
        $user = $this->userRepository->getUserByEmail($request->validated('email'));

        if (Hash::check($request->validated('password'), $userPassword = $user->password)) {
            return $this->responder
                ->success([
                    'token' => $user->createToken($userPassword)->plainTextToken,
                    'type' => 'bearer',
                ])->respond();
        }

        return responder()
            ->error('unauthenticated')
            ->respond(403);
    }
}
