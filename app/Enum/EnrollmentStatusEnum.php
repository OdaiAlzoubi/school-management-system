<?php

namespace App\Enum;

enum EnrollmentStatusEnum :string
{
    case ACTIVE = 'active';
    case GRADUATED = 'graduated';
    case WITHDRAWN = 'withdrawn';
    case SUSPENDED = 'suspended';
}
