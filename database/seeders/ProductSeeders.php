<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product = new Product();

        $product->name = 'Producto 1';
        $product->description = 'descripcion 1';
        $product->stock = 10;
        $product->created_at = date('Y-m-d H:i:s');
        $product->updated_at = date('Y-m-d H:i:s');

        $product->save();

        $product2 = new Product();

        $product2->name = 'Producto 2';
        $product2->description = 'descripcion 2';
        $product2->stock = 10;
        $product2->created_at = date('Y-m-d H:i:s');
        $product2->updated_at = date('Y-m-d H:i:s');

        $product2->save();

        $product3 = new Product();

        $product3->name = 'Producto 3';
        $product3->description = 'descripcion 3';
        $product3->stock = 10;
        $product3->created_at = date('Y-m-d H:i:s');
        $product3->updated_at = date('Y-m-d H:i:s');

        $product3->save();

        $product4 = new Product();

        $product4->name = 'Producto 4';
        $product4->description = 'descripcion 4';
        $product4->stock = 10;
        $product4->created_at = date('Y-m-d H:i:s');
        $product4->updated_at = date('Y-m-d H:i:s');

        $product4->save();

    }
}
