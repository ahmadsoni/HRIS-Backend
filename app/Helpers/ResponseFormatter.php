<?php

namespace App\Helpers;

use Illuminate\Http\JsonResponse;

class ResponseFormatter
{
    /**
     * Format JSON response.
     *
     * @param int $code
     * @param string $status
     * @param string|null $message
     * @param mixed|null $data
     * @param array|null $pagination
     * @param array|null $headers
     * @return JsonResponse
     */
    private static function formatResponse(
        int $code,
        string $status,
        ?string $message = null,
        $data = null,
        array $pagination = null,
        array $headers = []
    ): JsonResponse {
        $response = [
            'meta' => [
                'code' => $code,
                'status' => $status,
                'message' => $message,
            ],
            'data' => $data,
        ];

        if ($pagination) {
            $response['pagination'] = $pagination;
        }

        return response()->json($response, $code, $headers);
    }

    /**
     * Return a success response.
     *
     * @param mixed|null $data
     * @param string|null $message
     * @param array|null $pagination
     * @param array|null $headers
     * @return JsonResponse
     */
    public static function success(
        $data = null,
        ?string $message = 'Request was successful',
        array $pagination = null,
        array $headers = []
    ): JsonResponse {
        return self::formatResponse(200, 'success', $message, $data, $pagination, $headers);
    }

    /**
     * Return an error response.
     *
     * @param string|null $message
     * @param int $code
     * @param mixed|null $data
     * @param array|null $headers
     * @return JsonResponse
     */
    public static function error(
        ?string $message = 'An error occurred',
        int $code = 400,
        $data = null,
        array $headers = []
    ): JsonResponse {
        return self::formatResponse($code, 'error', $message, $data, null, $headers);
    }
}
