<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'categoryId' => 'required|exists:categories,id',
            'name' => 'required|string|unique:products,name',
            'description' => 'required|string',
            'price' => 'required|numeric',
        ];
    }
}
