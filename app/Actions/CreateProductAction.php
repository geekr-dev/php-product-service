<?php

namespace App\Actions;

use App\Models\Category;
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
        $category = Category::where('uuid', $data->category->uuid)->first();
        $product = Product::create([
            ...$data->toArray(),
            'category_id' => $category->id,
        ]);

        $this->redis->publishProductCreated(
            $product->toData(),
        );

        return $product;
    }
}
