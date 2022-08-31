<?php

namespace App\Parsers\Exceptions\ExceptionsJson;

use Exception;
use Illuminate\Http\JsonResponse;
use function response;

class JsonDepthException extends Exception
{
    /**
     * @return JsonResponse
     */
    public function render(): JsonResponse
    {
        return response()->json([$this->message]);
    }
}
