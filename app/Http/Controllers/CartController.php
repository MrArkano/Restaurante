<?php
namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;
class CartController extends Controller
{
 public function index() { return view('cart.index',['cart'=>session('cart',[])]); }
 public function store(Request $request, Product $product) { $quantity=max(1,(int)$request->input('quantity',1)); $cart=session('cart',[]); $current=$cart[$product->id]['quantity']??0; if(!$product->isAvailable()||$current+$quantity>$product->stock) return back()->with('error','Stock insuficiente.'); $cart[$product->id]=['id'=>$product->id,'name'=>$product->name,'franchise'=>$product->franchise,'image'=>$product->image,'price'=>$product->final_price,'original_price'=>$product->price,'quantity'=>$current+$quantity,'stock'=>$product->stock,'has_discount'=>$product->has_discount]; session(['cart'=>$cart]); return back()->with('success','Producto añadido al carrito.'); }
 public function update(Request $request) { $cart=session('cart',[]); foreach((array)$request->input('quantities',[]) as $id=>$quantity) { if(!isset($cart[$id])) continue; $product=Product::find($id); $quantity=(int)$quantity; if(!$product||$quantity<1||$quantity>$product->stock) return back()->with('error','Cantidad inválida para el stock disponible.'); $cart[$id]['quantity']=$quantity; $cart[$id]['stock']=$product->stock; } session(['cart'=>$cart]); return back()->with('success','Carrito actualizado.'); }
 public function destroy(Product $product) { $cart=session('cart',[]); unset($cart[$product->id]); session(['cart'=>$cart]); return back()->with('success','Producto eliminado del carrito.'); }
}
