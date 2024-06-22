<?php

declare(strict_types=1);

namespace App\Traits;

use Exception;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use JsonSerializable;
use Symfony\Component\HttpFoundation\Response;

use function response;

trait ApiResponseHelpers
{
    private string $message = '';

    private bool $shouldSaveResponse = true;

    private ?array $_api_helpers_defaultSuccessData = [
        'success' => true,
    ];

    public function respondNotFound(
        string|Exception $message,
        ?string $key = 'error',
        string|Exception|null $context = null
    ): JsonResponse {
        return $this->apiResponse(
            data: [$key => $this->morphMessage($message)],
            code: Response::HTTP_NOT_FOUND,
            context: $context
        );
    }

    public function respondWithSuccess(
        array|Arrayable|JsonSerializable|null $contents = null,
        string|Exception|null $context = null
    ): JsonResponse {
        $contents = $this->morphToArray(data: $contents) ?? [];

        $data = $contents === []
            ? $this->_api_helpers_defaultSuccessData
            : $contents;

        return $this->apiResponse(data: $data, context: $context);
    }

    public function setDefaultSuccessResponse(?array $content = null): self
    {
        $this->_api_helpers_defaultSuccessData = $content ?? [];

        return $this;
    }

    public function respondOk(string $message, string|Exception|null $context = null): JsonResponse
    {
        return $this->respondWithSuccess(contents: ['success' => $message], context: $context);
    }

    public function respondUnAuthenticated(?string $message = null, string|Exception|null $context = null): JsonResponse
    {
        return $this->apiResponse(
            data: ['error' => $message ?? 'Unauthenticated'],
            code: Response::HTTP_UNAUTHORIZED,
            context: $context
        );
    }

    public function respondForbidden(?string $message = null, string|Exception|null $context = null): JsonResponse
    {
        return $this->apiResponse(
            data: ['error' => $message ?? 'Forbidden'],
            code: Response::HTTP_FORBIDDEN,
            context: $context
        );
    }

    public function respondError(?string $message = null, string|Exception|null $context = null): JsonResponse
    {
        return $this->apiResponse(
            data: ['error' => $message ?? 'Error'],
            code: Response::HTTP_BAD_REQUEST,
            context: $context
        );
    }

    public function respondCreated(
        array|Arrayable|JsonSerializable|null $data = null,
        string|Exception|null $context = null
    ): JsonResponse {
        $data ??= [];

        return $this->apiResponse(
            data: $this->morphToArray(data: $data),
            code: Response::HTTP_CREATED,
            context: $context
        );
    }

    public function respondFailedValidation(
        string|Exception $message,
        ?string $key = 'error',
        string|Exception|null $context = null
    ): JsonResponse {
        return $this->apiResponse(
            data: [$key => $this->morphMessage($message)],
            code: Response::HTTP_UNPROCESSABLE_ENTITY,
            context: $context
        );
    }

    public function respondTeapot(string|Exception|null $context = null): JsonResponse
    {
        return $this->apiResponse(
            data: ['message' => 'I\'m a teapot'],
            code: Response::HTTP_I_AM_A_TEAPOT,
            context: $context
        );
    }

    public function respondNoContent(
        array|Arrayable|JsonSerializable|null $data = null,
        string|Exception|null $context = null
    ): JsonResponse {
        $data ??= [];
        $data = $this->morphToArray(data: $data);

        return $this->apiResponse(
            data: $data,
            code: Response::HTTP_NO_CONTENT,
            context: $context
        );
    }

    public function withMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function withoutSavingResponse(): self
    {
        $this->shouldSaveResponse = false;

        return $this;
    }

    private function apiResponse(array $data, int $code = 200, string|Exception|null $context = null): JsonResponse
    {
        if (! empty($this->message)) {
            $data = array_merge(['message' => $this->message], $data);
        }

        if ($this->shouldSaveResponse) {
            $uuid = Str::random();
            $this->saveResponse($data, $code, $context);
        }

        return response()->json(data: $data, status: $code);
    }

    private function saveResponse(array $data, int $code, string|array|Exception|null $context): void
    {
        Log::debug('API Response', [
            'reference' => request()->get('uuid'),
            'data' => $data,
            'context' => $context,
            'code' => $code,
        ]);
    }

    private function morphToArray(array|Arrayable|JsonSerializable|null $data): ?array
    {
        if ($data instanceof Arrayable) {
            return $data->toArray();
        }

        if ($data instanceof JsonSerializable) {
            return $data->jsonSerialize();
        }

        return $data;
    }

    private function morphMessage(string|Exception $message): string
    {
        return $message instanceof Exception
            ? $message->getMessage()
            : $message;
    }
}
