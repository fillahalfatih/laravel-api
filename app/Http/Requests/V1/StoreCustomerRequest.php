<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class StoreCustomerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $user = $this->user();

        return $user != null && $user->tokenCan('create');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'type' => 'required|string|in:Individual,Company',
            'email' => 'required|email|max:255|unique:customers,email',
            'address' => 'required|string|max:500',
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'type' => ucfirst(strtolower($this->type)),
        ]);
    }
}
