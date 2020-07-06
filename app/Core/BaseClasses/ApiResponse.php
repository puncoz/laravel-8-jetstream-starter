<?php

namespace App\Core\BaseClasses;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Trait ApiResponse
 * @package App\Core\BaseClasses
 */
trait ApiResponse
{
    /**
     * @param string                  $message
     * @param array|null|JsonResource $data
     * @param array                   $metadata
     *
     * @return array
     */
    public function makeResponse(string $message, $data, array $metadata = []): array
    {
        $response            = [];
        $response['success'] = true;

        if ( !is_null($data) ) {
            $response['data'] = $data;
        }

        if ( !empty($metadata) ) {
            $response['metadata'] = $metadata;
        }

        $response['message'] = $message;

        return $response;
    }

    /**
     * @param string $message
     * @param array  $data
     * @param array  $metadata
     *
     * @return array
     */
    public function makeError(string $message, array $data = [], array $metadata = []): array
    {
        $res = [
            'success' => false,
            'message' => $message,
        ];

        if ( !empty($data) ) {
            $res['data'] = $data;
        }

        if ( !empty($metadata) ) {
            $res['localization'] = $metadata;
        }

        return $res;
    }
}
