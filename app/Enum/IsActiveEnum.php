<?php

namespace App\Enum;

enum IsActiveEnum: string
{
    case ACTIVE = '1';
    case INACTIVE = '0';

    public function label(): string
    {
        return match ($this) {
            self::ACTIVE => __('enum.active'),
            self::INACTIVE => __('enum.inactive'),
        };
    }
}
