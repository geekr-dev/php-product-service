<?php

namespace App\Models;

use Ecommerce\Common\DTOs\Product\CategoryData;
use Ecommerce\Common\DTOs\Product\ProductData;
use Ecommerce\Common\Models\Concerns\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory, HasUuid;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_id',
        'uuid',
        'name',
        'description',
        'price',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'price' => 'float',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function toData(): ProductData
    {
        return new ProductData(
            id: $this->id,
            name: $this->name,
            description: $this->description,
            price: $this->price,
            category: new CategoryData(
                id: $this->category_id,
                name: $this->category->name,
            )
        );
    }

    public function getRouteKey()
    {
        return 'uuid';
    }
}
