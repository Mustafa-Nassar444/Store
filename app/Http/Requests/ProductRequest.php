<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'name' => ['required','string'],
            'category_id' => ['nullable','int', 'exists:products,id'],
            'description'=>['nullable','string'],
            'image'=>['image','max:4194304','dimensions:min_width=100,min_height=100'],
            'price'=>['numeric', 'min:0.00','max:99.99', 'regex:/^\d+(\.\d{1,2})?$/'],
            'compare_price'=>['nullable','numeric', 'min:0.00','max:99.99', 'regex:/^\d+(\.\d{1,2})?$/'],
            'status'=>['required','in:active,archived,draft']
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'The name field is Required',
            'category_id.exists'=>'Parent ID must be Exist',
            'description.string'=>'Description must be String',
            'image.image'=>'You Can Choose Images Only',
            'image.max'=>'Image Size must be less than 4 MB',
            'image.dimensions'=>'Image Dimensions is not allowed',
            'status.in'=>'The selected status is invalid',
            'status.required' => 'The status field is Required',

        ];
    }
}
