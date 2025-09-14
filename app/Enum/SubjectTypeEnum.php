<?php

namespace App\Enum;

enum SubjectTypeEnum: string
{
    case CORE = 'core';
    case ELECTIVE = 'elective';
    case OPTIONAL = 'optional';

    public function label(): string
    {
        return match ($this) {
            self::CORE => __('enum.core'),
            self::ELECTIVE => __('enum.elective'),
            self::OPTIONAL => __('enum.optional'),
        };
    }
}
