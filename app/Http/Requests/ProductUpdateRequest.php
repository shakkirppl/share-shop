<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
class ProductUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            //
            'code'=> ['required', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'category_id' => ['required', 'integer'],
            'sub_category_id' => ['required', 'integer'],
            'tax_id' => ['required', 'integer'],
            
        ];
    }
    public function messages()
    {
        return [
            'code.required' => 'Code is required',
            'name.required' => 'Name is required',
            'category_id.required' => 'Category is required',
            'sub_category_id.required' => 'Sub Category is required',
            'tax_id.required' => 'Tax is required',
         

        ];
    }
}
