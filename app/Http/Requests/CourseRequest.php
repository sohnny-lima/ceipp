<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CourseRequest extends FormRequest
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
        if ($this->routeIs('courses.upload')) {
            return [
                'file' => 'required|file|mimes:jpg,jpeg,png,gif,svg',
                'type' => 'required|string',
            ];
        }

        return [
            'titulo'     => 'required|string|max:255',
            'subtitulo'  => 'nullable|string|max:255',
            'description'=> 'nullable|string',
            'image' => 'nullable|string',
            'temp_path' => 'nullable|string',
        ];
    }
}
