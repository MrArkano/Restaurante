<?php
namespace App\Http\Controllers;
use App\Http\Requests\CheckoutRequest;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
class CheckoutController extends Controller
{
 public function index() { return view('checkout.index',['cart'=>session('cart',[])]); }
 public function store(CheckoutRequest $request): RedirectResponse {
  $cart=session('cart',[]); if(!$cart) return back()->with('error','El carrito está vacío.');
  $sale=DB::transaction(function() use($request,$cart){ $subtotal=0; $discount=0; $lines=[];
   foreach($cart as $line){ $product=Product::whereKey($line['id'])->lockForUpdate()->firstOrFail(); $qty=(int)$line['quantity']; if($qty<1||$qty>$product->stock) throw new \RuntimeException('Stock insuficiente para '.$product->name); $unit=$product->final_price; $lineSubtotal=round($unit*$qty,2); $subtotal+=round((float)$product->price*$qty,2); $discount+=round($product->discount_amount*$qty,2); $lines[]=compact('product','qty','unit','lineSubtotal'); }
   $sale=Sale::create(['customer_name'=>$request->customer_name,'customer_email'=>$request->customer_email,'subtotal'=>$subtotal,'discount'=>$discount,'total'=>round($subtotal-$discount,2),'card_name'=>$request->card_name,'card_brand'=>'prototype','card_last_four'=>substr($request->card_number,-4)]);
   foreach($lines as $line){ $p=$line['product']; $p->decrement('stock',$line['qty']); $sale->items()->create(['product_id'=>$p->id,'product_name'=>$p->name,'original_price'=>$p->price,'unit_price'=>$line['unit'],'quantity'=>$line['qty'],'discount_amount'=>$p->discount_amount,'subtotal'=>$line['lineSubtotal']]); }
   return $sale;
  });
  session()->forget('cart'); return to_route('checkout.success',$sale);
 }
 public function success(Sale $sale) { return view('checkout.success',compact('sale')); }
}
