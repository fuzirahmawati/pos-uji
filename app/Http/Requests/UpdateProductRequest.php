<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProductRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
{
    return [
        'category_id' => ['required', 'exists:categories,id'],
        'sku' => [
            'required',
            'string',
            'max:50',
            Rule::unique('products', 'sku')->ignore($this->product),
        ],
        'name' => ['required', 'string', 'max:150'],
        'sell_price' => ['required', 'numeric', 'min:0'],
        'stock' => ['required', 'integer', 'min:0'],
    ];
}
}
