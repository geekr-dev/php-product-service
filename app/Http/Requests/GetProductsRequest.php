<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class GetProductsRequest extends FormRequest
{
    public function getSortBy(): ?string
    {
        return $this->input('sortBy');
    }

    public function getSortDirection(): ?string
    {
        return $this->input('sortDirection');
    }

    public function getSearchTerm(): ?string
    {
        return $this->input('searchTerm');
    }

    public function rules()
    {
        return [
            'sortBy' => [
                'sometimes',
                new Enum(ProductSortBy::class),
            ],
            'sortDirection' => [
                'required_with:sortBy',
                new Enum(SortDirection::class),
            ],
            'searchTerm' => 'sometimes|string|min:1'
        ];
    }
}
