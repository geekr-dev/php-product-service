<?php

namespace Ecommerce\Common\DTOs\Product;

use Illuminate\Http\Request;
use Illuminate\Validation\Validator;
use Spatie\LaravelData\Data;

class ProductData extends Data
{
    public function __construct(
        public readonly ?int $id,
        public readonly string $name,
        public readonly string $description,
        public readonly float $price,
        public readonly CategoryData $category,
    ) {
    }

    public static function rules()
    {
        return [
            'categoryId' => 'required|exists:categories,id',
            'name' => 'required|string|unique:products,name',
            'description' => 'required|string',
            'price' => 'required|numeric',
        ];
    }

    public static function withValidator(Validator $validator): void
    {
        $validator->setRules(self::rules());
    }

    public static function fromRequest(Request $request): self
    {
        return self::from([
            'id' => $request->id,
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'category' => CategoryData::from([
                'id' => $request->categoryId,
                'name' => $request->categoryName,
            ])
        ]);
    }
}
