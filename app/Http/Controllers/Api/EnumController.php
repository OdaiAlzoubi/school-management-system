<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\EnumService;
use Soft\ApiResponse\Factories\ApiResponseFactory;

class EnumController extends Controller
{
    public function __construct(protected EnumService $enumService) {}

    public function shifts()
    {
        return $this->handleApi(function () {
            $shifts = $this->enumService->getShifts();
            return ApiResponseFactory::success()->data($shifts)->statusCode(200)->toJson();
        });
    }
}
