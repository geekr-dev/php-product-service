<?php

namespace Ecommerce\Common\DTOs\Product;

use Spatie\LaravelData\Data;

class CategoryData extends Data
{
    public function __construct(
        public readonly int $id,
        public readonly string $name,
    ) {
    }
}
