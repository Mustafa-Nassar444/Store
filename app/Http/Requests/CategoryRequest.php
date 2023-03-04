<?php

namespace App\Http\Requests;

use App\Models\User;
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['required','string','min:3', 'max:255'],
            'parent_id' => ['int', 'exists:categories,id'],
            'description'=>['string'],
            'image'=>['image','max:4194304','dimensions:min_width=100,min_height=100'],
            'status'=>['in:active,archived']
        ];
    }
}
