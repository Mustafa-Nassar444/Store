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
            'name' => ['required','string','min:3', 'max:255','unique:categories'],
            'parent_id' => ['nullable','int', 'exists:categories,id'],
            'description'=>['nullable','string'],
            'image'=>['image','max:4194304','dimensions:min_width=100,min_height=100'],
            'status'=>['required','in:active,archived']
        ];
    }
    public function messages()
{
    return [
        'name.required' => 'The name field is Required',
        'name.min' => 'Name must be at least 3 chars',
        'name.max' => 'Name cannot be more than 255 chars',
        'name.unique'=>'This Name already taken',
        'parent_id.exists'=>'Parent ID must be Exist',
        'description.string'=>'Description must be String',
        'image.image'=>'You Can Choose Images Only',
        'image.max'=>'Image Size must be less than 4 MB',
        'image.dimensions'=>'Image Dimensions is not allowed',
        'status.in'=>'The selected status is invalid',
        'status.required' => 'The status field is Required',

    ];
}

}
