<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'product_name_and_brand' => 'required|string|max:90',
            'price_unit' => 'required|string|max:45',
            'product_description' => 'required|string|max:100',
            'stock' => 'required|integer|min:0',
            'suppliers_id' => 'required|exists:suppliers,id',
        ];
    }

    public function messages(): array
    {
        return [
            'product_name_and_brand.required' => 'El nombre y marca del producto es obligatorio.',
            'price_unit.required' => 'El precio unitario es obligatorio.',
            'product_description.required' => 'La descripción del producto es obligatoria.',
            'stock.required' => 'La cantidad de existencias es obligatoria.',
            'stock.integer' => 'La cantidad de existencias debe ser un número entero.',
            'stock.min' => 'La cantidad de existencias no puede ser negativa.',
            'suppliers_id.required' => 'El proveedor es obligatorio.',
            'suppliers_id.exists' => 'El proveedor seleccionado no es válido.',
        ];
    }
}
