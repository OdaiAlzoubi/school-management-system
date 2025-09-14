<?php

namespace App\Http\Controllers\Api\School;

use App\Services\School\StudentService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Student\StudentFilterRequest;
use App\Http\Requests\Student\StudentStoreRequest;
use App\Http\Requests\Student\StudentUpdateRequest;
use Soft\ApiResponse\Factories\ApiResponseFactory;

class StudentController extends Controller
{
    public function __construct(protected StudentService $studentService) {}

    public function index(StudentFilterRequest $request)
    {
        return $this->handleApi(function () use ($request) {
            $students = $this->studentService->index($request->validated());
            return ApiResponseFactory::success()->data($students)->statusCode(200)->toJson();
        });
    }

    public function store(StudentStoreRequest $request)
    {
        return $this->handleApi(function () use ($request) {
            $data = $request->validated();
            $student = $this->studentService->create($data);
            return ApiResponseFactory::success()->data($student)->message(__('message.student.student_created_successfully'))->statusCode(201)->toJson();
        });
    }

    public function update(StudentUpdateRequest $request, int $id)
    {
        return $this->handleApi(function () use ($request, $id) {
            $data = $request->validated();
            $student = $this->studentService->find($id);
            if (!$student)
                return ApiResponseFactory::error()->message(__('message.student.student_not_found'))->statusCode(404)->toJson();
            $student = $this->studentService->update($data, $student->id);
            return ApiResponseFactory::success()->data($student)->message(__('message.student.student_updated_successfully'))->statusCode(200)->toJson();
        });
    }

    public function show($id)
    {
        return $this->handleApi(function () use ($id) {
            $student = $this->studentService->find($id);
            if (!$student)
                return ApiResponseFactory::error()->message(__('message.student.student_not_found'))->statusCode(404)->toJson();
            return ApiResponseFactory::success()->data($student)->statusCode(200)->toJson();
        });
    }

    public function destroy($id)
    {
        return $this->handleApi(function () use ($id) {
            $student = $this->studentService->find($id);
            if (!$student)
                return ApiResponseFactory::error()->message(__('message.student.student_not_found'))->statusCode(404)->toJson();
            $student = $this->studentService->delete($student->id);
            return ApiResponseFactory::success()->message(__('message.student.student_deleted_successfully'))->statusCode(200)->toJson();
        });
    }

    public function onlyTrashed()
    {
        return $this->handleApi(function () {
            $students = $this->studentService->onlyTrashed();
            return ApiResponseFactory::success()->data($students)->statusCode(200)->toJson();
        });
    }

    public function restore($id)
    {
        return $this->handleApi(function () use ($id) {
            $student = $this->studentService->restore($id);
            return ApiResponseFactory::success()->data($student)->message(__('message.student.student_restored_successfully'))->statusCode(200)->toJson();
        });
    }
}
