<?php

namespace App\Services\Academic;

use App\Repositories\Interface\GradeRepositoryInterface;


class GradeService
{
    public function __construct(protected GradeRepositoryInterface $gradeRepository, protected SectionService $sectionService) {}

    public function index()
    {
        $grades = $this->gradeRepository->all();

        return $grades;
    }
    public function store(array $data)
    {
        $grade = $this->gradeRepository->create($data);
        if (isset($data['sections'])) {
            foreach ($data['sections'] as $index => $value) {
                $value['grade_id'] = $grade->id;
                $this->sectionService->store($value);
            }
        }
        return $grade;
    }

    public function update(array $data, $id)
    {
        $this->gradeRepository->findOrFail($id);
        return $this->gradeRepository->update($data, $id);
    }

    public function delete($id)
    {
        $this->gradeRepository->findOrFail($id);
        return $this->gradeRepository->delete($id);
    }
}
