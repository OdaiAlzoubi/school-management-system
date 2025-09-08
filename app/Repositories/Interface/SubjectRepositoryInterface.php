<?php

namespace App\Repositories\Interface;

use Soft\RepositoryBase\Interface\RepositoryBaseInterface;

interface SubjectRepositoryInterface extends RepositoryBaseInterface
{
    public function filter(array $data);
}
