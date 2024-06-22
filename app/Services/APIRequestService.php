<?php

namespace App\Services;

use App\Enums\HttpMethod;
use Illuminate\Http\Client\Response;

class APIRequestService
{
    protected array $headers = [];

    protected array $query = [];

    protected array $body = [];

    protected string $timeout = '60';

    public function __construct(protected HttpMethod $method, protected string $uri)
    {
    }

    /**
     * Set headers for the request
     *
     * @return static
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

    /**
     * Get the headers for the request
     *
     * @return array
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * Set the query parameters for the request
     *
     * @return static
     */
    public function setQuery(array|string $key, ?string $value = null)
    {
        if (is_array($key)) {
            $this->query = $key;
        } else {
            $this->query[$key] = $value;
        }

        return $this;
    }

    /**
     * Get the query parameters for the request
     *
     * @return array
     */
    public function getQuery()
    {
        return $this->query;
    }

    /**
     * Get the body for the request
     *
     * @return static
     */
    public function setBody(array|string $key, ?string $value = null)
    {
        if (is_array($key)) {
            $this->query = $key;
        } else {
            $this->query[$key] = $value;
        }

        return $this;

    }

    /**
     * Get body for request
     *
     * @return array
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     *  Set the maximum time, in seconds, to wait for a response from the server.
     *
     * @return static
     */
    public function setTimeout(string $seconds)
    {
        $this->timeout = $seconds;

        return $this;
    }

    /**
     * Gets the amount of time before request should stop
     *
     *
     * @return string
     */
    public function getTimeout()
    {
        return $this->timeout;
    }

    /**
     * This method returns the URI for the API request.
     * If the query is empty, or we have a GET request, the URI can be returned
     * as is.
     * Otherwise, we need to append the query string to the URI.
     *
     * @return string
     */
    public function getUri()
    {
        if (empty($this->query) || $this->method === HttpMethod::GET) {
            return $this->uri;
        }

        return $this->uri.'?'.http_build_query($this->query);
    }

    /**
     * Get the http method of the request
     *
     * @return HttpMethod
     */
    public function getMethod()
    {
        return $this->method;
    }

    public static function get(string $uri = ''): static
    {

        return new static(HttpMethod::GET, $uri);
    }

    public static function post(string $uri = ''): static
    {
        return new static(HttpMethod::POST, $uri);
    }

    public static function put(string $uri = ''): static
    {
        return new static(HttpMethod::PUT, $uri);
    }

    public static function delete(string $uri = ''): static
    {
        return new static(HttpMethod::DELETE, $uri);
    }
}
