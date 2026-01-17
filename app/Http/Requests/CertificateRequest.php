<?php

namespace App\Http\Requests;

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CertificateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // luego puedes usar policies
    }

    public function rules(): array
    {
        return [
            'description' => 'nullable|string',
            'file' => 'required_without:id|string|nullable',
            'temp_path' => 'required_without:id|string|nullable',
        ];
    }
}
