<?php

namespace App\Http\Responses;

use App\Http\Resources\ApiResource;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;

class ApiResponse
{
    public static function returnSuccessOrFailedResponseWithResource(
        ?Model $resource,
        string $successMessage,
        string $errorMessage
    ): JsonResponse {
        if (is_null($resource)) {
            return response()->json(
                [
                    'status' => 'error',
                    'message' => $errorMessage
                ],
                400
            );
        }
        return (new ApiResource($resource))->additional(
            [
                'status' => 'success',
                'message' => $successMessage,
            ]
        )->response()->setStatusCode(200);
    }

}
