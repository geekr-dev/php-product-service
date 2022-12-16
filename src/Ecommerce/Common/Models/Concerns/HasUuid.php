<?php

namespace Ecommerce\Common\Models\Concerns;

use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

trait HasUuid
{
    public static function bootHasUuid(): void
    {
        static::creating(function (Model $model): void {
            $model->uuid = Uuid::uuid4()->toString();
        });
    }
}
