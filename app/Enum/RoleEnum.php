<?php

namespace App\Enum;

enum RoleEnum :string
{
    case SUPERADMINISTRATOR = 'superadministrator';
    case ADMINISTRATOR = 'administrator';
    case STUDENT = 'student';
    case TEACHER = 'teacher';
    case GUARDIAN = 'guardian';

    public function label() : string
    {
        return match($this){
            self::SUPERADMINISTRATOR => __('enum.superadministrator'),
            self::ADMINISTRATOR => __('enum.administrator'),
            self::STUDENT => __('enum.student'),
            self::TEACHER => __('enum.teacher'),
            self::GUARDIAN => __('enum.guardian'),
        };
    }
}
