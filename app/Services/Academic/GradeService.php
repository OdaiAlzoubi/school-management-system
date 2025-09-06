<?php

namespace App\Services\Academic;

use App\Repositories\Interface\GradeRepositoryInterface;


class GradeService
{
    public function __construct(protected GradeRepositoryInterface $gradeRepository) {}

    public function index(){
        return $this->gradeRepository->all();
    }
    public function store(array $data)
    {
        return $this->gradeRepository->create($data);
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
