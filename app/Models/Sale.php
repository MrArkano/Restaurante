<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
class Sale extends Model
{
    protected $fillable = ['customer_name','customer_email','subtotal','discount','total','card_name','card_brand','card_last_four'];
    protected $casts = ['subtotal'=>'decimal:2','discount'=>'decimal:2','total'=>'decimal:2'];
    public function items(): HasMany { return $this->hasMany(SaleItem::class); }
}
