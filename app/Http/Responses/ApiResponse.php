<?php

namespace App\Http\Responses;

use Illuminate\Contracts\Support\Responsable;

class APIResponse implements Responsable
{
    protected ?string $message;

    protected int $status = 200;

    protected array $headers = [];

    public function __construct()
    {
    }

    public function toResponse($request)
    {
        return response()->json($this->toCollection(), $this->status, $this->headers);
    }

    protected function toCollection()
    {
        return collect(
            [
                'message' => $this->getMessage(),
            ]
        );
    }

    /**
     * Get the value of status
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the value of status
     *
     * @return self
     */
    public function setStatus(int $status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get the value of message
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set the value of message
     *
     * @return self
     */
    public function setMessage(string $message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get the value of headers
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * Set the value of headers
     *
     * @return self
     */
    public function setHeaders(array|string $key, ?string $value = null)
    {
        if (is_array($key)) {
            $this->headers = $key;
        } else {
            $this->headers[$key] = $value;
        }

        return $this;
    }
}
