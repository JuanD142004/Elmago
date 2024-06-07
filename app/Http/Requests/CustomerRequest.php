<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
			'customer_name' => 'required|string',
			'company_name' => 'required|string',
			'location' => 'required|string',
			'cell_phone' => 'required',
			'mail' => 'string',
			'routes_id' => 'required',
			'enabled' => 'required',
        ];
    }
}