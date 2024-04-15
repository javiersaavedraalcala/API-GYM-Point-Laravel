<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClientRequest extends FormRequest
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
            'name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'cellphone' => 'required|max:10',
            'email' => 'required|email|unique:clients,email',
            'plan' => "required:['day', 'weekly', 'monthly', 'quarterly', 'semiannually', 'annually']"
        ];
    }
}
