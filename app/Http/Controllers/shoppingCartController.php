<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class shoppingCartController extends Controller
{

    // Mostrar productos del carrito =============
    public function showShopping(Request $request)
    {
        $shoppingView = DB::table('shopping_cart')->get();

        return view('store/shoppingCart', compact('shoppingView'));
    }

    // Añadir productos al carrito =============
    public function addShopping(Request $request)
    {

        $productExist = DB::table('shopping_cart')
        ->where('idProduct',$request->idProduct)
        ->first();

        DB::table('products')
            ->where('id', $request->idProduct)
            ->update([
                'stock' => $request->quantityProduct-1
            ]);



        if ($productExist) {
            DB::table('shopping_cart')
            ->where('idProduct', $request->idProduct)
            ->update([
                'stock' => $productExist->stock+1
            ]);
        } else {
            DB::table('shopping_cart')->insert([
                'name' => $request->nameProduct,
                'description' => $request->descriptionProduct,
                'stock' => 1,
                'idUser' => 1,
                'idProduct' => $request->idProduct
            ]);
        }

        return redirect()->route('products');
    }

    // Borrar productos del carrito =============
    public function deleteShopping(Request $request)
    {

        $productExist = DB::table('products')
        ->where('id',$request->idProduct)
        ->first();

        if ($request->one == 1) {

            DB::table('shopping_cart')
            ->where('id', $request->idShoppingProduct)
            ->update([
                'stock' => $request->quantityShoppingProduct-1
            ]);

            DB::table('products')
            ->where('id', $request->idProduct)
            ->update([
                'stock' => $productExist->stock+1
            ]);
        }else if ($request->all == 1) {

            DB::table('shopping_cart')
            ->where('id', $request->idProduct)
            ->delete();
        }

        return redirect()->route('products');
    }
}