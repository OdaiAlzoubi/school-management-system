<?php

namespace App\Http\Controllers\Api\School;

use App\Http\Controllers\Controller;
use App\Http\Requests\Teacher\TeacherFilterRequest;
use App\Services\School\TeacherService;
use App\Http\Requests\Teacher\TeacherStoreRequest;
use Soft\ApiResponse\Factories\ApiResponseFactory;
use App\Http\Requests\Teacher\TeacherUpdateRequest;

class TeacherController extends Controller
{
    public function __construct(protected TeacherService $teacherService) {}

    public function index(TeacherFilterRequest $request)
    {
        return $this->handleApi(function () use ($request) {
            $teachers = $this->teacherService->index($request->validated());
            return ApiResponseFactory::success()->data($teachers)->message(__('message.teacher.teacher_list_successfully'))->statusCode(200)->toJson();
        });
    }
    public function create(TeacherStoreRequest $request)
    {
        return $this->handleApi(function () use ($request) {
            $teacher = $this->teacherService->create($request->validated());
            return ApiResponseFactory::success()->data($teacher)->message(__('message.teacher.teacher_created_successfully'))->statusCode(201)->toJson();
        });
    }

    public function update(TeacherUpdateRequest $request, int $id)
    {
        return $this->handleApi(function () use ($request, $id) {
            $teacher = $this->teacherService->update($request->validated(), $id);
            return ApiResponseFactory::success()->data($teacher)->message(__('message.teacher.teacher_updated_successfully'))->statusCode(200)->toJson();
        });
    }

    public function show(int $id)
    {
        return $this->handleApi(function () use ($id) {
            $teacher = $this->teacherService->show($id);
            return ApiResponseFactory::success()->data($teacher)->message(__('message.teacher.teacher_show_successfully'))->statusCode(200)->toJson();
        });
    }
}
