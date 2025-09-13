<?php

namespace App\Enum;

enum ShiftEnum: string
{
    case MORNING = 'morning';
    case EVENING = 'evening';

    public function label(): string
    {
        return match ($this) {
            self::MORNING => __('enum.morning'),
            self::EVENING => __('enum.evening'),
        };
    }
}
