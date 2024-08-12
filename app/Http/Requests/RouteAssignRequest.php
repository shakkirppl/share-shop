<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
class RouteAssignRequest extends FormRequest
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
            'route_id' => ['required', 'integer'],
            'van_id' => ['required', 'integer'],
            'user_id' => ['required', 'integer'],
            
        ];
    }
    public function messages()
    {
        return [

            'route_id.required' => 'Please Select Route',
            'van_id.required' => 'Please Select Van',
            'user_id.required' => 'Please Select User',


        ];
    }
}
