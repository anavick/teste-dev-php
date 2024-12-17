<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSupplierRequest extends FormRequest
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
            'name' => 'string|nullable|max:100',
            'name_company' => 'string|nullable|max:100',
            'email' => 'string|required|max:100|unique:suppliers,email',
            'cnpj' => 'string|required|size:14|unique:suppliers,cnpj',
            'street' => 'string|required|max:100',
            'number' => 'string|required',
            'complement' => 'string|nullable|max:100',
            'neighborhood' => 'string|nullable|max:100',
            'city' => 'string|required|max:100',
            'state' => 'string|required|max:2',
            'zip_code' => 'string|required|size:8',
            'contact' => 'string|required|size:11',
            'ativo' => 'boolean|nullable',
        ];
    }
}
