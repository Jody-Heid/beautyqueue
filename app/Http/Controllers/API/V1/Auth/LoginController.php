<?php

namespace App\Http\Controllers\API\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use App\Traits\ApiResponseHelpers;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    use ApiResponseHelpers;

    public function authentication(LoginRequest $request)
    {
        $user = User::where('email', $request->validated('email'))->first();
        $userPassword = $user->password;
        if ($user && Hash::check($request->validated('password'), $userPassword)) {

            $token = $user->createToken($userPassword)->plainTextToken;

            return $this
                ->withMessage('Login Successful')
                ->respondWithSuccess([
                    'authorization' => [
                        'token' => $token,
                        'type' => 'bearer',
                    ]]);
        }

        return $this->respondUnAuthenticated();
    }
}
