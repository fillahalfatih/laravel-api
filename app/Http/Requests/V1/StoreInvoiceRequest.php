<?php

namespace App\Http\Requests\V1;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class StoreInvoiceRequest extends FormRequest
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
            'amount' => 'required|numeric|min:0',
            'customerId' => 'required|exists:customers,id',
            'status' => 'required|string|in:Paid,Unpaid,Voided',
            'billedDate' => 'required|date',
            'paidDate' => 'nullable|date|after_or_equal:billedDate',
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'status' => ucfirst(strtolower($this->status)),
            'customer_id' => $this->customerId,
            'billed_date' => Carbon::createFromFormat('d-m-Y', $this->billedDate)->format('Y-m-d'),
            'paid_date' => $this->paidDate
                ? Carbon::createFromFormat('d-m-Y', $this->paidDate)->format('Y-m-d')
                : null,
        ]);
    }
}
