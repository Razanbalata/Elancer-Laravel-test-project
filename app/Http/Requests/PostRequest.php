<?php

namespace App\Http\Requests;

use App\Rules\Restricted;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'min:3', 'max:255'],
            'content' => [
                'required',
                'string',
                'max:99999',
                new Restricted(['god','admin'])
            ],
            'category_id' => [
            'nullable',
            'exists:categories,id'
        ],
            'cover' => [
                'nullable',
                'image',
                'mimetypes:image/png,image/jpeg',
                'dimensions:min_width=600,min_height=400,max_width=2000,max_height=2000',
                'max:1024'
            ],
            'tags' => ['nullable', 'string', 'max:255'],
        ];
    }

    public function messages(): array
    {
        return [
            'required' => ':attribute is Required!',
            'title.required' => ':attribute is mandatory!',
        ];
    }

    public function attributes(): array
    {
        return [
            'title' => 'post Title',
            'content' => 'post Content',
            'cover' => 'cover Image',
        ];
    }
}
