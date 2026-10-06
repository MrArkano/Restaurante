<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class SaleItem extends Model
{
    protected $fillable = ['sale_id','product_id','product_name','original_price','unit_price','quantity','discount_amount','subtotal'];
    protected $casts = ['original_price'=>'decimal:2','unit_price'=>'decimal:2','discount_amount'=>'decimal:2','subtotal'=>'decimal:2'];
    public function sale(): BelongsTo { return $this->belongsTo(Sale::class); }
    public function product(): BelongsTo { return $this->belongsTo(Product::class); }
}
