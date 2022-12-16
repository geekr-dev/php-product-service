<?php

namespace Ecommerce\Common\DTOs\Product;

use Illuminate\Http\Request;
use Illuminate\Validation\Validator;

class ProductData
{
    public function __construct(
        public readonly ?int $id,
        public readonly string $name,
        public readonly string $description,
        public readonly float $price,
        public readonly CategoryData $category,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new static(
            $data['id'],
            $data['name'],
            $data['description'],
            $data['price'],
            new CategoryData(
                $data['category']['id'],
                $data['category']['name'],
            )
        );
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }
}
