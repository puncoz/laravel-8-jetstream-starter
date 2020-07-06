<?php

namespace App\Core\BaseClasses\Controller;

use App\Core\BaseClasses\ApiResponse;
use Arr;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;

/**
 * Class ApiController
 * @package App\Core\BaseClasses\Controller
 */
class ApiController extends Controller
{
    use ApiResponse;

    /**
     * @var array
     */
    protected $errors = [];

    /**
     * @var array
     */
    protected $metadata = [];

    /**
     * @param array|null|JsonResource $result
     * @param string                  $message
     * @param int                     $code
     *
     * @return JsonResponse
     */
    public function sendResponse($result = [], $message = 'success', $code = Response::HTTP_OK)
    {
        if ( Arr::has($result, 'meta') ) {
            $this->metadata = $result['meta'];
            unset($result['meta']);
        }

        return response()->json($this->makeResponse($message, $result, $this->metadata), $code);
    }

    /**
     * @param string $error
     * @param int    $code
     *
     * @return JsonResponse
     */
    public function sendError($error = "error", $code = Response::HTTP_NOT_FOUND)
    {
        return response()->json($this->makeError($error, $this->errors, $this->metadata), $code);
    }

    /**
     * @param $errors
     *
     * @return $this
     */
    public function setValidationErrors(Collection $errors)
    {
        $this->errors = $errors->toArray();

        return $this;
    }

    /**
     * @param array $metadata
     *
     * @return $this
     */
    public function setMetadata(array $metadata)
    {
        $this->metadata = $metadata;

        return $this;
    }
}
