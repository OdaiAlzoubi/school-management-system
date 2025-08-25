<?php

namespace App\Http\Requests\Student;

use Illuminate\Foundation\Http\FormRequest;

class StudentFilterRequest extends FormRequest
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
        $rules['id'] = ['nullable', 'exists:students,id'];
        $rules['student_number'] = ['nullable', 'exists:students,student_number'];
        $rules['enrollment_status'] = ['nullable', 'exists:students,enrollment_status'];
        $rules['nationality'] = ['nullable', 'exists:students,nationality'];
        $rules['current_section_id'] = ['nullable', 'exists:students,current_section_id'];
        return $rules;
    }
}
