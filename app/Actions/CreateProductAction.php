<?php

namespace App\Actions;

use App\Models\Product;
use App\Services\RedisService;
use Ecommerce\Common\DTOs\Product\ProductData;

class CreateProductAction
{
    public function __construct(
        private readonly RedisService $redis,
    ) {
    }

    public function execute(ProductData $data): Product
    {
        $product = Product::create([
            ...$data->toArray(),
            'category_id' => $data->category->id,
        ]);
        $this->redis->publishProductCreated(
            $product->toData(),
        );
        return $product;
    }
}
