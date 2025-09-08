<?php

namespace App\Repositories;

use App\Models\Subject;
use Soft\RepositoryBase\RepositoryBase;
use App\Repositories\Interface\SubjectRepositoryInterface;

class SubjectRepository extends RepositoryBase implements SubjectRepositoryInterface
{
    public function __construct()
    {
        parent::__construct(new Subject());
    }

    public function filter(array $data)
    {
        $query = $this->model->query();
        if (isset($data['id']))
            $query->where('id', $data['id']);
        if (isset($data['grade_id']))
            $query->where('grade_id', $data['grade_id']);
        if (isset($data['is_active']))
            $query->where('is_active', $data['is_active']);
        if (isset($data['is_offered']))
            $query->where('is_offered', $data['is_offered']);
        if (isset($data['start_date']) && isset($data['end_date']))
            $query->whereBetween('created_at', [$data['start_date'], $data['end_date']]);
        elseif (isset($data['start_date']))
            $query->where('created_at', '>=', $data['start_date']);
        elseif (isset($data['end_date']))
            $query->where('created_at', '<=', $data['end_date']);
        return $query->get();
    }
}
