<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
 public function up(): void {
  Schema::create('categories', function (Blueprint $t) { $t->id(); $t->string('name')->unique(); $t->string('slug')->unique(); $t->timestamps(); });
  Schema::create('products', function (Blueprint $t) { $t->id(); $t->foreignId('category_id')->constrained()->cascadeOnDelete(); $t->string('name'); $t->text('description'); $t->decimal('price',10,2); $t->unsignedInteger('stock'); $t->string('franchise'); $t->string('image')->nullable(); $t->timestamps(); $t->index(['name','franchise']); });
  Schema::create('sales', function (Blueprint $t) { $t->id(); $t->string('customer_name'); $t->string('customer_email'); $t->decimal('subtotal',10,2); $t->decimal('discount',10,2)->default(0); $t->decimal('total',10,2); $t->string('card_name'); $t->string('card_brand')->nullable(); $t->string('card_last_four',4); $t->timestamps(); });
  Schema::create('sale_items', function (Blueprint $t) { $t->id(); $t->foreignId('sale_id')->constrained()->cascadeOnDelete(); $t->foreignId('product_id')->constrained()->restrictOnDelete(); $t->string('product_name'); $t->decimal('original_price',10,2); $t->decimal('unit_price',10,2); $t->unsignedInteger('quantity'); $t->decimal('discount_amount',10,2)->default(0); $t->decimal('subtotal',10,2); $t->timestamps(); });
 }
 public function down(): void { Schema::dropIfExists('sale_items'); Schema::dropIfExists('sales'); Schema::dropIfExists('products'); Schema::dropIfExists('categories'); }
};
