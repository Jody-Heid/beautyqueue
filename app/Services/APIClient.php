<?php

namespace App\Services;

use App\Enums\HttpMethod;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

abstract class APIClient
{
    /**
     * Send an ApiRequest to the API and return the response.
     *
     * @return Response
     */
    public function send(APIRequestService $request)
    {
        $response = $this->getBaseRequest()
            ->withHeaders($request->getHeaders())
            ->timeout($request->getTimeout())
            ->{$request->getMethod()->value}(
                $request->getUri(),
                $request->getMethod() === HttpMethod::GET
                ? $request->getQuery()
                : $request->getBody()
            );

        return $response;
    }

    /**
     * Get a base request for the API.
     * This method has some helpful defaults for API requests.
     * The base request is a PendingRequest with JSON acceptance, a content type
     * of 'application/json', and the base URL for the API.
     * It also throws exceptions for non-successful responses.
     *
     * @return PendingRequest
     */
    protected function getBaseRequest()
    {
        $request = Http::acceptJson()
            ->contentType('application/json')
            ->baseUrl($this->baseUrl());

        return $this->authorize($request);
    }

    /**
     * Authorize a request for the API.
     * This method is intended to be overridden by subclasses to provide
     * API-specific authorization.
     * By default, it simply returns the given request.
     *
     * @return PendingRequest
     */
    protected function authorize(PendingRequest $request)
    {
        return $request;
    }

    /**
     * Get the base URL for the API.
     * This method must be implemented by subclasses to provide the base URL for
     * the API.
     *
     * @return string
     */
    abstract protected function baseUrl();
}
