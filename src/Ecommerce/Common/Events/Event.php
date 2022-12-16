<?php

namespace Ecommerce\Common\Events;

abstract class Event
{
    abstract function toArray(): array;

    public function toJson()
    {
        return json_encode($this->toArray());
    }
}
