<?php

namespace App\Http\Controllers\Api\Academic;

use App\Http\Controllers\Controller;
use App\Services\Academic\GradeService;
use App\Http\Requests\Grade\GradeStoreRequest;
use App\Http\Requests\Grade\GradeUpdateRequest;
use Soft\ApiResponse\Factories\ApiResponseFactory;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    public function __construct(protected GradeService $gradeService) {}

    public function index(Request $request)
    {
        return $this->handleApi(function () use ($request) {
            $grades = $this->gradeService->index($request);
            return ApiResponseFactory::success()->data($grades)->statusCode(200)->toJson();
        });
    }
    public function store(GradeStoreRequest $request)
    {
        return $this->handleApi(function () use ($request) {
            $grade = $this->gradeService->store($request->validated());
            return ApiResponseFactory::success()->data($grade)->message(__('message.grade.grade_created_successfully'))->statusCode(201)->toJson();
        });
    }

    public function update(GradeUpdateRequest $request, int $id)
    {
        return $this->handleApi(function () use ($request, $id) {
            $grade = $this->gradeService->update($request->validated(), $id);
            return ApiResponseFactory::success()->data($grade)->message(__('message.grade.grade_updated_successfully'))->statusCode(200)->toJson();
        });
    }

    public function destroy(int $id)
    {
        return $this->handleApi(function () use ($id) {
            $this->gradeService->delete($id);
            return ApiResponseFactory::success()->message(__('message.grade.grade_deleted_successfully'))->statusCode(200)->toJson();
        });
    }

    public function show($id)
    {
        return $this->handleApi(function () use ($id) {
            $grade = $this->gradeService->show($id);
            return ApiResponseFactory::success()->data($grade)->statusCode(200)->toJson();
        });
    }
}
