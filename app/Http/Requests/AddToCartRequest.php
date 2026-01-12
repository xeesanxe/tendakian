<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Product;

class AddToCartRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'id' => 'required|integer|exists:products,id',
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'qty' => 'sometimes|integer|min:1|max:10',
        ];
    }

    /**
     * Configure the validator instance.
     */
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $productId = $this->input('id');
            $requestedQty = $this->input('qty', 1);
            
            // Check if product exists and is active
            $product = Product::find($productId);
            if (!$product || !$product->is_active) {
                $validator->errors()->add('id', 'Product is not available.');
                return;
            }
            
            // Check stock availability
            if ($product->stock < $requestedQty) {
                $validator->errors()->add('qty', "Only {$product->stock} items available in stock.");
                return;
            }
            
            // Verify price matches (prevent price manipulation)
            if (abs($product->price - $this->input('price')) > 0.01) {
                $validator->errors()->add('price', 'Product price has changed. Please refresh the page.');
            }
        });
    }

    /**
     * Get custom error messages.
     */
    public function messages(): array
    {
        return [
            'id.exists' => 'The selected product does not exist.',
            'qty.max' => 'Maximum 10 items can be added at once.',
            'qty.min' => 'Quantity must be at least 1.',
        ];
    }
}
