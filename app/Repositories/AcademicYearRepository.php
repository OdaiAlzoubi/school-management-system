<?php

namespace App\Repositories;

use App\Models\AcademicYear;
use Soft\RepositoryBase\RepositoryBase;
use App\Repositories\Interface\GradeRepositoryInterface;

class AcademicYearRepository extends RepositoryBase implements GradeRepositoryInterface
{
    public function __construct()
    {
        parent::__construct(new AcademicYear());
    }
}
