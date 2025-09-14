<?php

namespace App\Services;

use App\Enum\RoleEnum;
use App\Enum\ShiftEnum;
use App\Enum\GenderEnum;
use App\Enum\IsActiveEnum;
use App\Enum\SubjectTypeEnum;
use App\Enum\EnrollmentStatusEnum;

class EnumService
{

    public function getShifts()
    {
        return collect(ShiftEnum::cases())->map(fn($shift) => ['value' => $shift->value, 'label' => $shift->label()]);
    }

    public function getEnrollmentStatus()
    {
        return collect(EnrollmentStatusEnum::cases())->map(fn($status) => ['value' => $status->value, 'label' => $status->label()]);
    }

    public function getGender()
    {
        return collect(GenderEnum::cases())->map(fn($gender) => ['value' => $gender->value, 'label' => $gender->label()]);
    }

    public function getRole()
    {
        return collect(RoleEnum::cases())->map(fn($role) => ['value' => $role->value, 'label' => $role->label()]);
    }

    public function getIsActive()
    {
        return collect(IsActiveEnum::cases())->map(fn($status) => ['value' => $status->value, 'label' => $status->label()]);
    }

    public function getSubjectType()
    {
        return collect(SubjectTypeEnum::cases())->map(fn($type) => ['value' => $type->value, 'label' => $type->label()]);
    }
}
