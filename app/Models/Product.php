<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $fillable = ['category_id','name','description','price','stock','franchise','image'];
    protected $casts = ['price' => 'decimal:2', 'stock' => 'integer'];
    protected $appends = ['has_discount','final_price','discount_amount','is_available','stock_status'];

    public function category(): BelongsTo { return $this->belongsTo(Category::class); }
    public function saleItems(): HasMany { return $this->hasMany(SaleItem::class); }
    public function hasDiscount(): bool { return $this->stock > 20; }
    public function finalPrice(): float { return round((float) $this->price * ($this->hasDiscount() ? .9 : 1), 2); }
    public function discountAmount(): float { return round((float) $this->price - $this->finalPrice(), 2); }
    public function isAvailable(): bool { return $this->stock > 0; }
    public function stockStatus(): string { return $this->stock < 1 ? 'out-of-stock' : ($this->stock <= 5 ? 'low-stock' : 'in-stock'); }
    protected function getHasDiscountAttribute(): bool { return $this->hasDiscount(); }
    protected function getFinalPriceAttribute(): float { return $this->finalPrice(); }
    protected function getDiscountAmountAttribute(): float { return $this->discountAmount(); }
    protected function getIsAvailableAttribute(): bool { return $this->isAvailable(); }
    protected function getStockStatusAttribute(): string { return $this->stockStatus(); }
}
