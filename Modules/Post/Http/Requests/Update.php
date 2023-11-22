<?php

namespace Modules\Post\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Update extends FormRequest
{
    public function rules(): array
    {
        return [
            'title'       => 'string|required',
            'quote'       => 'string|nullable',
            'summary'     => 'string|required',
            'description' => 'string|nullable',
            'photo'       => 'string|nullable',
            'tags'        => 'nullable',
            'added_by'    => 'nullable',
            'category'    => 'sometimes|array',
            'category.*'  => 'required|exists:categories,id',
            'status'      => 'required|in:active,inactive',
        ];
    }
    
    public function authorize(): bool
    {
        return true;
    }
}
