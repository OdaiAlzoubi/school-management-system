<?php

namespace App\Http\Requests\Grade;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\Section\SectionUpdateRequest;

class GradeUpdateRequest extends FormRequest
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
        $rules['name'] = ['required', 'string', 'max:60', 'unique:grades,name,' . $this->id];
        $rules['code'] = ['nullable', 'string', 'max:5', 'unique:grades,code,' . $this->id];
        $rules['description'] = ['nullable', 'string', 'max:255'];
        $rules['order'] = ['required', 'integer'];
        $rules['sections'] = ['nullable', 'array'];
        if (request()->has('sections')) {
            $rulesSection = (new SectionUpdateRequest())->rules();
            foreach ($rulesSection as $key => $value) {
                $rules['sections.*.' .'id'] = ['nullable', 'integer', 'exists:sections,id'];
                if ($key == 'grade_id')
                    continue;
                $rules['sections.*.' . $key] = $value;
            }
        }
        return $rules;
    }
}
