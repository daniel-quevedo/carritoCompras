<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class productsController extends Controller
{
    public function listProducts()
    {
        $productsView = DB::table('products')->get();

        return view('products/products', compact('productsView'));
    }

    public function addProduct(Request $request)
    {

        DB::table('products')->insert([
            'name'=> $request->name,
            'description' => $request->description,
            'stock' => $request->quantity
        ]);

        return redirect()->route('products');
    }

    public function showProduct(Request $request)
    {
        $productEdit = DB::table('products')
        ->where('id',$request->idEditProduct)
        ->get();

        return view('products/editProduct', compact('productEdit'));
    }

    public function editProduct(Request $request)
    {
        DB::table('products')
        ->where('id',$request->idEditProduct)
        ->update([
            'name' => $request->name,
            'description' => $request->description,
            'stock' => $request->quantity
        ]);

        return redirect()->route('products');
    }

    public function deleteProduct(Request $request)
    {

        DB::table('products')
        ->where('id', $request->idDeleteProduct)->delete();

        return redirect()->route('products');
    }
}
