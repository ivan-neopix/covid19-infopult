<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
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
        $nameUniqueRule = Rule::unique('categories', 'name');
        if ($category = $this->route('category')) {
            $nameUniqueRule->ignore($category->id);
        }

        return [
            'name' => [
                'required',
                'string',
                'max:255',
                $nameUniqueRule,
            ],
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'naziv',
        ];
    }
}
