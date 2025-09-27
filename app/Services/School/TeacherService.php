<?php

namespace App\Services\School;

use App\Repositories\Interface\UserRepositoryInterface;
use App\Services\School\UserService;


class TeacherService
{
    public function __construct(protected UserService $userService, protected UserRepositoryInterface $userRepository) {}

    public function index(array $data)
    {
        return $this->userRepository->filter($data);
    }
    public function create(array $data)
    {
        $user = $this->userService->create($data['user']);
        return $user;
    }

    public function update(array $data, $id)
    {
        $user = $this->userService->update($data['user'], $id);
        return $user;
    }

    public function show($id)
    {
        return $this->userRepository->findOrFail($id);
    }
}
