<?php

namespace App\Http\Controllers\Api\Academic;

use App\Http\Controllers\Controller;
use App\Services\Academic\SubjectService;
use App\Http\Requests\Subject\SubjectStoreRequest;
use Soft\ApiResponse\Factories\ApiResponseFactory;
use App\Http\Requests\Subject\SubjectUpdateRequest;
use App\Http\Requests\Subject\SubjectFilterRequest;

class SubjectController extends Controller
{
    public function __construct(protected SubjectService $subjectService) {}

    public function index(SubjectFilterRequest $request)
    {
        return $this->handleApi(function () use ($request) {
            $subjects = $this->subjectService->index($request->validated());
            return ApiResponseFactory::success()->data($subjects)->statusCode(200)->toJson();
        });
    }

    public function store(SubjectStoreRequest $request)
    {
        return $this->handleApi(function () use ($request) {
            $subject = $this->subjectService->store($request->validated());
            return ApiResponseFactory::success()->data($subject)->message(__('message.subject.subject_created_successfully'))->statusCode(201)->toJson();
        });
    }

    public function update(SubjectUpdateRequest $request, $id)
    {
        return $this->handleApi(function () use ($request, $id) {
            $subject = $this->subjectService->update($request->validated(), $id);
            return ApiResponseFactory::success()->data($subject)->message(__('message.subject.subject_updated_successfully'))->statusCode(200)->toJson();
        });
    }

    public function destroy($id)
    {
        return $this->handleApi(function () use ($id) {
            $this->subjectService->delete($id);
            return ApiResponseFactory::success()->message(__('message.subject.subject_deleted_successfully'))->statusCode(200)->toJson();
        });
    }
}
