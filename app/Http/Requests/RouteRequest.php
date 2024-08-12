<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
class RouteRequest extends FormRequest
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
            'code' => ['required', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            
            
        ];
    }
    public function messages()
    {
        return [

            'code.required' => 'Code is required',
            'name.required' => 'Name is required',
           


        ];
    }
}
