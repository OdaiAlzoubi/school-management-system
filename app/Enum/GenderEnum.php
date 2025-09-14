<?php

namespace App\Enum;

enum GenderEnum :string
{
    case MALE = 'male';
    case FEMALE = 'female';
    case OTHER = 'other';

    public function label() : string
    {
        return match($this){
            self::MALE => __('enum.male'),
            self::FEMALE => __('enum.female'),
            self::OTHER => __('enum.other'),
        };
    }
}
