<?php

namespace App\Http\Controllers\Api\Academic;

use App\Http\Controllers\Controller;
use App\Services\Academic\AcademicYearService;
use Soft\ApiResponse\Factories\ApiResponseFactory;
use App\Http\Requests\AcademicYear\AcademicYearStoreRequest;
use App\Http\Requests\AcademicYear\AcademicYearUpdateRequest;

class AcademicYearController extends Controller
{
    public function __construct(protected AcademicYearService $academicYearService) {}

    public function index()
    {
        return $this->handleApi(function () {
            $academicYear = $this->academicYearService->index();
            return ApiResponseFactory::success()->data($academicYear)->statusCode(200)->toJson();
        });
    }
    public function store(AcademicYearStoreRequest $request)
    {
        return $this->handleApi(function () use ($request) {
            $academicYear = $this->academicYearService->store($request->validated());
            return ApiResponseFactory::success()->data($academicYear)->message(__('message.academicYear.academic_year_created_successfully'))->statusCode(201)->toJson();
        });
    }

    public function update(AcademicYearUpdateRequest $request, $id)
    {
        return $this->handleApi(function () use ($request, $id) {
            $academicYear = $this->academicYearService->update($request->validated(), $id);
            return ApiResponseFactory::success()->data($academicYear)->message(__('message.academicYear.academic_year_updated_successfully'))->statusCode(200)->toJson();
        });
    }

    public function destroy($id)
    {
        return $this->handleApi(function () use ($id) {
            $this->academicYearService->delete($id);
            return ApiResponseFactory::success()->message(__('message.academicYear.academic_year_deleted_successfully'))->statusCode(200)->toJson();
        });
    }
}
