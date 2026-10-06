<?php
namespace App\Http\Controllers;
use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
class ProductController extends Controller
{
 public function index() { return view('products.index',['products'=>Product::with('category')->latest()->paginate(15)]); }
 public function create() { return view('products.create',['categories'=>Category::orderBy('name')->get()]); }
 public function store(ProductRequest $request): RedirectResponse { $data=$request->validated(); if($request->hasFile('image')) $data['image']=$request->file('image')->store('products','public'); Product::create($data); return to_route('products.index')->with('success','Producto creado correctamente.'); }
 public function show(Product $product) { return view('products.show',compact('product')); }
 public function edit(Product $product) { return view('products.edit',['product'=>$product,'categories'=>Category::orderBy('name')->get()]); }
 public function update(ProductRequest $request, Product $product): RedirectResponse { $data=$request->validated(); if($request->hasFile('image')) { if($product->image) Storage::disk('public')->delete($product->image); $data['image']=$request->file('image')->store('products','public'); } $product->update($data); return to_route('products.index')->with('success','Producto actualizado correctamente.'); }
 public function destroy(Product $product): RedirectResponse { if($product->image) Storage::disk('public')->delete($product->image); $product->delete(); return to_route('products.index')->with('success','Producto eliminado.'); }
}
