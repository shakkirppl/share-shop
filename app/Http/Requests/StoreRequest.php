<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'comapny_id' => ['required', 'integer'],
            'contact_number' => ['required', 'string'],
            'email' => ['required', 'email'],
            'username' => ['required', 'email'],
            'password' => ['required', 'string'],
           
        ];
    }
    public function messages()
    {
        return [

            'name.required' => 'Name is required',
            'comapny_id.required' => 'Company is required',
            'contact_number.required' => 'Contact Number is required',
            'email.required' => 'Email is required ',
            'username.required' => 'User Name (Using Email Format) is required',
            'password.required' => 'Password is required',
           

        ];
    }
}
