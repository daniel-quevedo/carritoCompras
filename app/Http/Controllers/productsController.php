<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ProductsImport;
use DateTime;

class productsController extends Controller
{
    // Mostrar productos ========================
    public function listProducts(Request $request)
    {
        $productsView = DB::table('products')->get();
        $shoppingView = DB::table('shopping_cart')->get();

        return view('products/products', compact('productsView','shoppingView'));
    }

    // Añadir productos ========================
    public function addProduct(Request $request)
    {

        DB::table('products')->insert([
            'name'=> $request->name,
            'description' => $request->description,
            'stock' => $request->quantity,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        return redirect()->route('products')->with('addProd','Añadido Exitosamente');
    }

    // Mostrar producto a editar ========================
    public function showProduct(Request $request)
    {
        $productEdit = DB::table('products')
        ->where('id',$request->idEditProduct)
        ->get();

        return view('products/editProduct', compact('productEdit'));
    }

    // Editar productos ========================
    public function editProduct(Request $request)
    {
        DB::table('products')
        ->where('id',$request->idEditProduct)
        ->update([
            'name' => $request->name,
            'description' => $request->description,
            'stock' => $request->quantity,
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        return redirect()->route('products')->with('editProd','Editado Correctamente');
    }

    // Eliminar productos ========================
    public function deleteProduct(Request $request)
    {

        DB::table('products')
        ->where('id', $request->idDeleteProduct)->delete();

        return redirect()->route('products')->with('deleteProd','Eliminado Correctamente');
    }

    // Importar productos desde .CSV =============
    public function importProducts(Request $request)
    {
        $productsImports = $request->file('imports');

        Excel::import(new ProductsImport, $productsImports);

        return redirect()->route('products');
    }
}
