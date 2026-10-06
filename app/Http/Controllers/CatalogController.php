<?php
namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
class CatalogController extends Controller
{
 public function index(Request $request) { 
     $products = Product::with('category')
        ->when($request->filled('search'), fn($q) => $q->where(fn($x) => $x->where('name', 'like', '%' . $request->search . '%')->orWhere('franchise', 'like', '%' . $request->search . '%')))
        ->when($request->filled('category'), fn($q) => $q->where('category_id', $request->category))
        ->when($request->filled('franchise'), fn($q) => $q->where('franchise', $request->franchise))
        ->latest()->paginate(12)->withQueryString(); 
     
     return view('catalog.index', [
         'products' => $products, 
         'categories' => Category::orderBy('name')->get(),
         'franchises' => Product::select('franchise')->whereNotNull('franchise')->distinct()->pluck('franchise')
     ]); 
 }
 public function show(Product $product) { return view('catalog.show',compact('product')); }
}
