<?php

declare(strict_types=1);

namespace App\Http\Responses;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ResponseFactory
{
    /**
     * @param Request $request
     * @param mixed $data
     * @param int $code
     * @param bool $success
     * @param string $message
     * @param array $errors
     * @return JsonResponse
     */
    public static function create(
        Request $request,
        $data = [],
        int $code = 200,
        bool $success = true,
        string $message = '',
        array $errors = []
    ): JsonResponse
    {
        $formats = $request->headers->get('content-type');

        switch ($formats) {
            default:
                $response = static::createJsonResponse($data, $code, $success, $message, $errors);
        }

        return $response;
    }

    /**
     * @param mixed $data
     * @param int $code
     * @param bool $success
     * @param string $message
     * @param array $errors
     * @return JsonResponse
     */
    protected static function createJsonResponse(
        $data,
        int $code = 200,
        bool $success = true,
        string $message = '',
        array $errors = []
    ): JsonResponse
    {
        $response = [
            'success' => $success,
            'message' => $message,
            'errors' => $errors,
            'data' => $data,
        ];

        return new JsonResponse($response, $code);
    }
}
