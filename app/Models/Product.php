<?php

namespace App\Models;

use App\Support\NormalizesModelBooleans;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Product extends Model
{
    use HasFactory;
    use NormalizesModelBooleans;

    protected $guarded = [];

    public const CHECKBOX_FLAGS = [
        'hot_deals',
        'featured',
        'special_offer',
        'special_deals',
    ];

    protected $casts = [
        'hot_deals' => 'boolean',
        'featured' => 'boolean',
        'special_offer' => 'boolean',
        'special_deals' => 'boolean',
        'status' => 'boolean',
    ];

    protected static function booted(): void
    {
        static::saving(function (Product $product) {
            $product->normalizeNullBooleans([
                ...self::CHECKBOX_FLAGS,
                'status',
            ]);
        });
    }

    /**
     * @return array<string, bool>
     */
    public static function checkboxFlagsFromRequest(Request $request): array
    {
        $flags = [];

        foreach (self::CHECKBOX_FLAGS as $key) {
            $flags[$key] = $request->boolean($key);
        }

        return $flags;
    }

    public function vendor(){
        return $this->belongsTo(User::class, 'vendor_id', 'id')->withDefault();
    }

    public function category(){
        return $this->belongsTo(Category::class, 'category_id', 'id')->withDefault();
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id', 'id')->withDefault();
    }

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class, 'subcategory_id', 'id')->withDefault();
    }
}
