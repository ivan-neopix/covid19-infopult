<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EditPostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'category_id' => ['required', 'integer', 'bail', Rule::exists('categories', 'id')],
            'tags' => ['required', 'string'],
        ];
    }

    public function attributes()
    {
        return [
            'category_id' => 'kategorija',
            'tags' => 'tagovi',
        ];
    }
}
