<?php

namespace App\Models;

use App\Enum\EnrollmentStatusEnum;
use App\Enum\GenderEnum;
use App\Enum\RoleEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Observers\StudentObserver;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Student extends Model
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'user_id',
        'student_number',
        'admission_date',
        'enrollment_status',
        'roll_number',
        'blood_type',
        'nationality',
        'emergency_contact',
        'current_grade_id',
        'current_section_id',
        'extra_attributes',
    ];

    protected $with = ['user'];

    public static function boot()
    {
        parent::boot();
        self::observe(StudentObserver::class);
        static::creating(function ($model) {
            $model->uuid = (string) Str::uuid();
        });
    }

    protected function casts(): array
    {
        return [
            'extra_attributes' => 'json',
            'enrollment_status' => EnrollmentStatusEnum::class,
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
