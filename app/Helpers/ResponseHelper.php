<?php

namespace App\Helpers;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ResponseHelper
{
    /**
     * @param $attributes
     * @param string|null $message
     * @return JsonResponse
     */
    public static function success($attributes = null, string $message = null): JsonResponse
    {
        return self::response(Response::HTTP_OK, $attributes, $message ?? __("success"));
    }

    /**
     * @param $attributes
     * @param string|null $message
     * @return JsonResponse
     */
    public static function store($attributes = null, string $message = null): JsonResponse
    {
        return self::response(Response::HTTP_OK, $attributes, $message ?? __("store"));
    }

    /**
     * @param $attributes
     * @param string|null $message
     * @return JsonResponse
     */
    public static function update($attributes = null, string $message = null): JsonResponse
    {
        return self::response(Response::HTTP_OK, $attributes, $message ?? __("update"));
    }

    /**
     * @param $attributes
     * @param string|null $message
     * @return JsonResponse
     */
    public static function destroy($attributes = null, string $message = null): JsonResponse
    {
        return self::response(Response::HTTP_OK, $attributes, $message ?? __("destroy"));
    }

    /**
     * @param $attributes
     * @param string|null $message
     * @return JsonResponse
     */
    public static function restore($attributes = null, string $message = null): JsonResponse
    {
        return self::response(Response::HTTP_OK, $attributes, $message ?? __("restore"));
    }

    /**
     * @param $attributes
     * @param string|null $message
     * @return JsonResponse
     */
    public static function badRequest($attributes = null, string $message = null): JsonResponse
    {
        return self::response(Response::HTTP_BAD_REQUEST, $attributes, $message ?? __("badRequest"));
    }

    /**
     * @param $attributes
     * @param string|null $message
     * @return JsonResponse
     */
    public static function unauthorized($attributes = null, string $message = null): JsonResponse
    {
        return self::response(Response::HTTP_UNAUTHORIZED, $attributes, $message ?? __("unauthorized"));
    }

    /**
     * @param $attributes
     * @param string|null $message
     * @return JsonResponse
     */
    public static function notFound($attributes = null, string $message = null): JsonResponse
    {
        return self::response(Response::HTTP_NOT_FOUND, $attributes, $message ?? __("notFound"));
    }

    /**
     * @param $attributes
     * @param string|null $message
     * @return JsonResponse
     */
    public static function internalServerError($attributes = null, string $message = null): JsonResponse
    {
        return self::response(Response::HTTP_INTERNAL_SERVER_ERROR, $attributes, $message ?? __("internalServerError"));
    }

    /**
     * @param int $statusCode
     * @param $attributes
     * @param string $message
     * @return JsonResponse
     */
    public static function response(int $statusCode, $attributes, string $message): JsonResponse
    {
        return response()->json([
            'message' => $message,
            'data' => $attributes
        ], $statusCode);
    }
}
