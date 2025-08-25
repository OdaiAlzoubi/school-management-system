<?php

namespace App\Services\School;

use Illuminate\Support\Facades\DB;
use App\Repositories\Interface\StudentRepositoryInterface;

class StudentService
{
    public function __construct(protected StudentRepositoryInterface $studentRepository, protected UserService $userService) {}

    public function create(array $data)
    {
        DB::beginTransaction();
        $user = $this->userService->create($data['user']);
        $data['user_id'] = $user->id;
        $student = $this->studentRepository->create($data);
        DB::commit();
        return $student;
    }

    public function index(array $data)
    {
        return $this->studentRepository->filter($data);
    }

    public function update(array $data, int $id)
    {
        DB::beginTransaction();
        $data['user_id'] = $this->studentRepository->findOrFail($id)->user_id;
        $this->userService->update($data['user'], $data['user_id']);
        return $this->studentRepository->update($data, $id);
        DB::commit();
    }

    public function find($id)
    {
        try {
            $student = $this->studentRepository->findOrFail($id);
        } catch (\Exception $e) {
            return null;
        }
        return $student;
    }

    public function show($id)
    {
        $student = $this->find($id);
        return $student;
    }

    public function delete($id)
    {
        return $this->studentRepository->delete($id);
    }
}
