<?php

namespace App\Services\Academic;

use App\Models\Enrollment;
use App\Repositories\Interface\EnrollmentRepositoryInterface;


class EnrollmentService
{
    public function __construct(protected EnrollmentRepositoryInterface $enrollmentRepository) {}

    public function index()
    {
        return $this->enrollmentRepository->with(['grade:id,name','section:id,name','academicYear:id,name','student:id,user_id','student.user:id,name'])->get();
    }
    public function store(array $data)
    {
        return $this->enrollmentRepository->create($data);
    }

    public function update(array $data, $id)
    {
        $this->enrollmentRepository->findOrFail($id);
        return $this->enrollmentRepository->update($data, $id);
    }

    public function delete($id)
    {
        $this->enrollmentRepository->findOrFail($id);
        return $this->enrollmentRepository->delete($id);
    }
}
