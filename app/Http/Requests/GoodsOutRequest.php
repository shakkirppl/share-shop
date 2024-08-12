<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
class GoodsOutRequest extends FormRequest
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
            'customer_id' => ['required', 'integer'],
            'in_date' => ['required'],
            'invoice_no' => ['required', 'string'],
            'total' => ['required|numeric|min:0|not_in:0'],
            'total_tax' => ['required|numeric|min:0|not_in:0'],
            'grand_total' => ['required|numeric|min:0|not_in:0'],
            'receipt' => ['required|numeric|min:0|not_in:0'],
            'item_id0.*' => 'required|numeric|distinct|min:1',
            'quantity.*' => 'required|numeric|min:0',
            'mrp.*' => 'required|numeric|min:0',
            'rate.*' => 'required|numeric|min:0',
            'taxable.*' => 'required|numeric|min:0',
            'tax.*' => 'required|numeric|min:0',
            'amount.*' => 'required|numeric|min:0',
        ];
    }
    public function messages()
    {
        return [

            'customer_id.required' => 'Customer is required',
            'in_date.required' => 'Date is required',

        ];
    }
}
