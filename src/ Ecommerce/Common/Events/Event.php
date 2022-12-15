<?php

namespace Ecommerce\Common\Events;

class Event
{
    public function toJson()
    {
        return json_encode([
            'type' => $this->type,
            'data' => $this->data,
        ]);
    }
}
