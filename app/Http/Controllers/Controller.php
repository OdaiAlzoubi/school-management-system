<?php

namespace App\Http\Controllers;

use Throwable;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Soft\ApiResponse\Factories\ApiResponseFactory;
abstract class Controller
{
    protected function handleApi(\Closure $callback): JsonResponse
    {
        try {
            return $callback();
        } catch (\Illuminate\Validation\ValidationException $e) {
            return $this->handleException($e, 422, 'Validation failed.', $e->errors());
        } catch (\Symfony\Component\HttpKernel\Exception\NotFoundHttpException $e) {
            return $this->handleException($e, 404, 'Resource not found.');
        } catch (\Illuminate\Auth\AuthenticationException $e) {
            return $this->handleException($e, 401, 'Unauthenticated.');
        } catch (\Illuminate\Auth\Access\AuthorizationException $e) {
            return $this->handleException($e, 403, 'Forbidden.');
        } catch (\Illuminate\Database\QueryException $e) {
            return $this->handleException($e, 500, 'Database error.');
        } catch (\DomainException $e) {
            return $this->handleException($e, 400, 'Business logic error.');
        } catch (\Exception $e) {
            return $this->handleException($e, 500, 'An unexpected error occurred.');
        } catch (\Throwable $e) {
            return $this->handleException($e, 500, 'Critical system error.');
        }
    }

    private function handleException(\Throwable $e, int $code, string $defaultMessage, $errors = []): JsonResponse
    {
        $this->logError($e);

        $message = app()->environment('production') && $code === 500
            ? 'Something went wrong. Please try again later.'
            : $e->getMessage();

        return ApiResponseFactory::validationError()
            ->message($defaultMessage ?: $message)
            ->errors($errors)
            ->statusCode($code)
            ->toJson();
    }

    private function logError(Throwable $e): void
    {
        Log::error('API Error', [
            'user_id' => auth()->id(),
            'request' => request()->all(),
            'message' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine(),
            'trace' => $e->getTraceAsString(),
        ]);
    }
}
