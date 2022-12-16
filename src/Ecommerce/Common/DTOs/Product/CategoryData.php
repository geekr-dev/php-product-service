<?php

namespace Ecommerce\Common\DTOs\Product;

class CategoryData
{
    public function __construct(
        public readonly int $id,
        public readonly string $name,
    ) {
    }

    public static function fromArray(array $data): self
    {
        return new static($data['id'], $data['name']);
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }
}
