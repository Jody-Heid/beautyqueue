<?php

namespace App\Exceptions;

use App\Traits\ApiResponseHelpers;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    use ApiResponseHelpers;

    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });

        $this->renderable(function (AppointmentStatusException $e, $request) {
            return $e->render($request);
        });

    }

    public function render($request, Throwable $e)
    {
        if ($e instanceof ModelNotFoundException) {
            return $this->respondNotFound('Resource not found.', 'error', $e->getMessage());
        }

        return parent::render($request, $e);
    }

    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return $this->respondUnAuthenticated();
        }

        return redirect()->guest(route('auth.login'));
    }
}
