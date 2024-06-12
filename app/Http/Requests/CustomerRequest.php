<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\UniqueNormalized;

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
            'customer_name' => ['required', 'string', new UniqueNormalized('customers', 'customer_name')],
            'company_name' => ['required', 'string', new UniqueNormalized('customers', 'company_name')],
            'location' => 'required|string',
            'cell_phone' => ['required', new UniqueNormalized('customers', 'cell_phone')],
            'mail' => ['nullable', 'string', new UniqueNormalized('customers', 'mail')],
            'routes_id' => 'required',
            'enabled' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'customer_name.required' => 'El nombre del cliente es obligatorio.',
            'company_name.required' => 'El nombre de la empresa es obligatorio.',
            'location.required' => 'La dirección es obligatoria.',
            'cell_phone.required' => 'El número de celular es obligatorio.',
            'cell_phone.regex' => 'El número de celular debe tener 10 dígitos.',
            'mail.required' => 'El correo es obligatorio.',
            'mail.email' => 'El correo debe ser una dirección válida.',
            'routes_id.required' => 'La ruta es obligatoria.',
            'routes_id.exists' => 'La ruta seleccionada no es válida.',
            'enabled.required' => 'El estado habilitado es obligatorio.',
        ];
    }
}