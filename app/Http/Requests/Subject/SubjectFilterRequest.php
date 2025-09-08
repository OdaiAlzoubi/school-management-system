<?php

namespace App\Http\Requests\Subject;

use Illuminate\Foundation\Http\FormRequest;

class SubjectFilterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [];
        $rules['id'] = ['nullable', 'integer', 'exists:subjects,id'];
        $rules['grade_id'] = ['nullable', 'integer', 'exists:grades,id'];
        $rules['is_active'] = ['nullable', 'boolean'];
        $rules['is_offered'] = ['nullable', 'boolean'];
        $rules['start_date'] = ['nullable', 'date'];
        $rules['end_date'] = ['nullable', 'date'];
        return $rules;
    }
}
