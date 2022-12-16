<?php

namespace Ecommerce\Common\Events\Product;

use Ecommerce\Common\DTOs\Product\ProductData;
use Ecommerce\Common\Enums\Events;
use Ecommerce\Common\Events\Event;

class ProductCreatedEvent extends Event
{
    const TYPE = Events::PRODUCT_CREATED;

    public function __construct(
        public readonly ProductData $data
    ) {
    }

    public function toArray(): array
    {
        return [
            'type' => self::TYPE,
            'data' => $this->data
        ];
    }
}
