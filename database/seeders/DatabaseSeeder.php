<?php
namespace Database\Seeders;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
class DatabaseSeeder extends Seeder
{
 public function run(): void {
  foreach (['Cómics','Ropa','Coleccionables','Accesorios'] as $name) Category::firstOrCreate(['slug'=>Str::slug($name)], ['name'=>$name]);
  if (Product::exists()) return;
  $items = [['Neon Genesis Evangelion #01','Cómics','Evangelion',24.99,32],['Cyberpunk Jacket','Ropa','Cyberpunk 2077',89.90,12],['Samus Aran Figure','Coleccionables','Metroid',74.50,24],['Pixel Power Bank','Accesorios','Nintendo',29.99,18]];
  foreach ($items as [$name,$category,$franchise,$price,$stock]) Product::create(['category_id'=>Category::where('name',$category)->value('id'),'name'=>$name,'description'=>'Artículo seleccionado de la colección NerdVault.','price'=>$price,'stock'=>$stock,'franchise'=>$franchise]);
 }
}
