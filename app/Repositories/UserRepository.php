<?php

namespace App\Repositories;

use App\Enum\RoleEnum;
use App\Models\User;
use Soft\RepositoryBase\RepositoryBase;
use App\Repositories\Interface\UserRepositoryInterface;

class UserRepository extends RepositoryBase implements UserRepositoryInterface
{
    public function __construct()
    {
        parent::__construct(new User());
    }

    public function filter(array $data)
    {
        $query = $this->model->query();
        if (isset($data['id']))
            $query->where('id', $data['id']);
        if (isset($data['is_active']))
            $query->where('is_active', $data['is_active']);
        if (isset($data['start_date']) && isset($data['end_date']))
            $query->whereBetween('created_at', [$data['start_date'], $data['end_date']]);
        elseif (isset($data['start_date']))
            $query->where('created_at', '>=', $data['start_date']);
        elseif (isset($data['end_date']))
            $query->where('created_at', '<=', $data['end_date']);
        $query->where('role', RoleEnum::TEACHER->value);
        return $query->get();
    }
}
