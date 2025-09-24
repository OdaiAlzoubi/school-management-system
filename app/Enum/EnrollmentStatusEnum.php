<?php

namespace App\Enum;

enum EnrollmentStatusEnum: string
{
    case ACTIVE = 'active';
    case COMPLETED = 'completed';
    case WITHDRAWN = 'withdrawn';

    public function label(): string
    {
        return match ($this) {
            self::ACTIVE => __('enum.active'),
            self::COMPLETED => __('enum.completed'),
            self::WITHDRAWN => __('enum.withdrawn'),
        };
    }

    public function color(){
        return match ($this) {
            self::ACTIVE => 'success',
            self::COMPLETED => 'info',
            self::WITHDRAWN => 'danger',
        };
    }
    public function toArray(): array
    {
        return [
            'value' => $this->value,
            'label' => $this->label(),
            'color' => $this->color(),
        ];
    }
}
