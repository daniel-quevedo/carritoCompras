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
                'stock' => $request->quantityProduct-1,
                'updated_at' => date('Y-m-d H:i:s')
            ]);



        if ($productExist) {
            DB::table('shopping_cart')
            ->where('idProduct', $request->idProduct)
            ->update([
                'stock' => $productExist->stock+1,
                'updated_at' => date('Y-m-d H:i:s')
            ]);
        } else {
            DB::table('shopping_cart')->insert([
                'name' => $request->nameProduct,
                'description' => $request->descriptionProduct,
                'stock' => 1,
                'idUser' => 1,
                'idProduct' => $request->idProduct,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);
        }

        return redirect()->route('products')->with('addShop','Agregado al carrito');
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
                'stock' => $request->quantityShoppingProduct-1,
                'updated_at' => date('Y-m-d H:i:s')
            ]);

            DB::table('products')
            ->where('id', $request->idProduct)
            ->update([
                'stock' => $productExist->stock+1,
                'updated_at' => date('Y-m-d H:i:s')
            ]);
        }else if ($request->all == 1) {

            DB::table('shopping_cart')
            ->where('id', $request->idProduct)
            ->delete();
        }

        return redirect()->route('products')->with('deleteShop','Eliminado del carrito');
    }
}