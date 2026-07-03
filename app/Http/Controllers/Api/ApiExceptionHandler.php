<?php

namespace App\Http\Controllers\Api;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use PHPOpenSourceSaver\JWTAuth\Exceptions\JWTException;
use PHPOpenSourceSaver\JWTAuth\Exceptions\TokenExpiredException;
use PHPOpenSourceSaver\JWTAuth\Exceptions\TokenInvalidException;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class ApiExceptionHandler
{
    public static function render(Throwable $e): JsonResponse
    {
        return match (true) {
            $e instanceof ValidationException => self::json(
                422,
                'Validation failed',
                ['errors' => $e->errors()]
            ),

            $e instanceof ModelNotFoundException => self::json(404, self::notFoundMessage($e)),

            $e instanceof NotFoundHttpException && $e->getPrevious() instanceof ModelNotFoundException => self::json(
                404,
                self::notFoundMessage($e->getPrevious())
            ),

            $e instanceof NotFoundHttpException => self::json(404, 'Resource not found'),

            $e instanceof TokenExpiredException => self::json(401, 'Token has expired'),
            $e instanceof TokenInvalidException => self::json(401, 'Token is invalid'),
            $e instanceof JWTException => self::json(401, 'Token not provided'),
            $e instanceof AuthenticationException => self::json(401, 'Unauthorized'),

            $e instanceof AuthorizationException => self::json(403, 'Forbidden'),

            $e instanceof HttpExceptionInterface => self::json(
                $e->getStatusCode(),
                $e->getMessage() ?: self::defaultMessageFor($e->getStatusCode())
            ),

            default => self::json(500, 'Internal Server Error', config('app.debug') ? ['error' => $e->getMessage()] : []),
        };
    }

    private static function defaultMessageFor(int $status): string
    {
        return match ($status) {
            401 => 'Unauthorized',
            403 => 'Forbidden',
            404 => 'Resource not found',
            422 => 'Validation failed',
            429 => 'Too many requests, please try again later',
            default => 'Internal Server Error',
        };
    }

    private static function notFoundMessage(ModelNotFoundException $e): string
    {
        $model = class_basename($e->getModel());

        $label = match ($model) {
            'Karyawan' => 'Employee',
            default => $model,
        };

        return "{$label} not found";
    }

    private static function json(int $status, string $message, array $extra = []): JsonResponse
    {
        return response()->json(array_merge([
            'status' => false,
            'message' => $message,
        ], $extra), $status);
    }
}
