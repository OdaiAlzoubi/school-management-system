<?php

namespace App\Services;

use App\Enum\ShiftEnum;

class EnumService
{

    public function getShifts()
    {
        return collect(ShiftEnum::cases())->map(fn($shift) => ['value' => $shift->value, 'label' => $shift->label()]);
    }
}
