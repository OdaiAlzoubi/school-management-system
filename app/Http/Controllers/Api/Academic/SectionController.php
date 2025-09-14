<?php

namespace App\Http\Controllers\Api\Academic;

use App\Http\Controllers\Controller;
use App\Services\Academic\SectionService;
use App\Http\Requests\Section\SectionStoreRequest;
use App\Http\Requests\Section\SectionUpdateRequest;
use Soft\ApiResponse\Factories\ApiResponseFactory;

class SectionController extends Controller
{
    public function __construct(protected SectionService $sectionService) {}

    public function store(SectionStoreRequest $request)
    {
        return $this->handleApi(function () use ($request) {
            $section = $this->sectionService->store($request->validated());
            return ApiResponseFactory::success()->data($section)->message(__('message.section.section_created_successfully'))->statusCode(201)->toJson();
        });
    }

    public function update(SectionUpdateRequest $request, int $id)
    {
        return $this->handleApi(function () use ($request, $id) {
            $section = $this->sectionService->update($request->validated(), $id);
            return ApiResponseFactory::success()->data($section)->message(__('message.section.section_updated_successfully'))->statusCode(200)->toJson();
        });
    }

    public function destroy(int $id)
    {
        return $this->handleApi(function () use ($id) {
            $this->sectionService->delete($id);
            return ApiResponseFactory::success()->message(__('message.section.section_deleted_successfully'))->statusCode(200)->toJson();
        });
    }
}
