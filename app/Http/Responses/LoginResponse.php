<?php

namespace App\Http\Responses;

class LoginResponse extends APIResponse
{
    protected ?string $token = null;

    public function setToken(string $token)
    {
        $this->token = $token;

        return $this;
    }

    public function getToken()
    {
        return $this->token;
    }

    public function toCollection()
    {
        return parent::toCollection()->merge([
            'token' => $this->token,
        ])->filter(function ($value) {
            return ! is_null($value);
        });
    }
}
