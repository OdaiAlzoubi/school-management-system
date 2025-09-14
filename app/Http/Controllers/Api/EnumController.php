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

    public function enrollmentStatus()
    {
        return $this->handleApi(function () {
            $status = $this->enumService->getEnrollmentStatus();
            return ApiResponseFactory::success()->data($status)->statusCode(200)->toJson();
        });
    }

    public function gender()
    {
        return $this->handleApi(function () {
            $gender = $this->enumService->getGender();
            return ApiResponseFactory::success()->data($gender)->statusCode(200)->toJson();
        });
    }

    public function role()
    {
        return $this->handleApi(function () {
            $role = $this->enumService->getRole();
            return ApiResponseFactory::success()->data($role)->statusCode(200)->toJson();
        });
    }

    public function isActive()
    {
        return $this->handleApi(function () {
            $status = $this->enumService->getIsActive();
            return ApiResponseFactory::success()->data($status)->statusCode(200)->toJson();
        });
    }

    public function subjectType()
    {
        return $this->handleApi(function () {
            $type = $this->enumService->getSubjectType();
            return ApiResponseFactory::success()->data($type)->statusCode(200)->toJson();
        });
    }
}
