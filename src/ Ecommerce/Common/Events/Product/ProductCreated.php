<?php

namespace Ecommerce\Common\Events\Product;

use Ecommerce\Common\DTOs\Product\ProductData;
use Ecommerce\Common\Enums\Events;
use Ecommerce\Common\Events\Event;

class ProductCreatedEvent extends Event
{
    public string $type = Events::PRODUCT_CREATED;
    public function __construct(
        public readonly ProductData $data
    ) {
    }
}
