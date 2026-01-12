<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
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
            'name' => 'required_without_all:c_fname,c_lname|string|max:255',
            'c_fname' => 'required_without:name|string|max:255',
            'c_lname' => 'required_without:name|string|max:255',
            'email' => 'required_without:c_email_address|email|max:255',
            'c_email_address' => 'required_without:email|email|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
            'rental_start' => 'nullable|date|after_or_equal:today',
            'rental_end' => 'nullable|date|after_or_equal:rental_start',
            'payment_method' => 'nullable|string|in:manual,mock,bank_transfer,credit_card',
            'notes' => 'nullable|string|max:1000',
        ];
    }

    /**
     * Get custom error messages for validation rules.
     */
    public function messages(): array
    {
        return [
            'rental_start.after_or_equal' => 'Rental start date must be today or later.',
            'rental_end.after_or_equal' => 'Rental end date must be after or equal to start date.',
            'email.required_without' => 'Email address is required.',
            'name.required_without_all' => 'Name is required.',
        ];
    }

    /**
     * Get the validated data with normalized fields.
     */
    public function getValidatedData(): array
    {
        $validated = $this->validated();
        
        // Normalize name fields
        if (!isset($validated['name']) && isset($validated['c_fname'], $validated['c_lname'])) {
            $validated['name'] = trim($validated['c_fname'] . ' ' . $validated['c_lname']);
        }
        
        // Normalize email fields
        if (!isset($validated['email']) && isset($validated['c_email_address'])) {
            $validated['email'] = $validated['c_email_address'];
        }
        
        return $validated;
    }
}
