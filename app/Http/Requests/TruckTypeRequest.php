<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TruckTypeRequest extends FormRequest
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
			'truck_brand' => 'required|string',
			'plate' => 'required|string',
			'ability' => 'required|string',
			'enabled' => 'required',
        ];
    }
}
