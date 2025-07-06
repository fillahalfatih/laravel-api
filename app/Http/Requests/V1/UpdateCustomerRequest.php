<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCustomerRequest extends FormRequest
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
        $method = $this->method();

        if($method == 'PUT') {
            return [
                'name' => 'required|string|max:255',
                'type' => 'required|string|in:Individual,Company',
                'email' => 'required|email|max:255|unique:customers,email',
                'address' => 'required|string|max:500',
            ];
        } else {
            return [
                'name' => 'sometimes|required|string|max:255',
                'type' => 'sometimes|required|string|in:Individual,Company',
                'email' => 'sometimes|required|email|max:255|unique:customers,email',
                'address' => 'sometimes|required|string|max:500',
            ];
        }
    }

    protected function prepareForValidation(): void
    {
        if ($this->has('type')) {
            $this->merge([
                'type' => ucfirst(strtolower($this->type)),
            ]);
        }
    }
}
