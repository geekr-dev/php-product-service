<?php

namespace App\Models;

use Ecommerce\Common\DTOs\Product\ProductData;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\LaravelData\WithData;

class Product extends Model
{
    use HasFactory, WithData;

    protected $dataClass = ProductData::class;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
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
}
