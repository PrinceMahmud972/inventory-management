<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductSizeStock;
use App\Models\ProductStock;
use App\Models\ReturnProduct;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class ReturnProductsController extends Controller
{
    public function returnProduct() {
        return view('products.return');
    }

    public function returnProductSubmit(Request $request) {
        //validate form data
        $validate = Validator::make($request->all(), [
            'product_id' => 'required|numeric',
            'date' => 'required|string',
            'items' => 'required'
        ]);

        if($validate->fails()){
            return response()->json([
                'success' => false,
                'errors' => $validate->errors()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        // return product store
        foreach($request->items as $item) {

            // somehow $item returning value as associative array, so I needed to typcast $item as an object in order to use -> notaion on $item.
            $item = (object) $item;


            if($item->quantity && $item->quantity>0) {
                $new_item = new ReturnProduct();
                $new_item->product_id = $request->product_id;
                $new_item->date = $request->date;
                $new_item->size_id = $item->size_id;
                $new_item->quantity = $item->quantity;
                $new_item->save();

                // Update Product Stock Size
                $product_size_quantity = ProductSizeStock::where('product_id', $request->product_id)
                                        ->where('size_id', $item->size_id)
                                        ->first();
                // Add to Stock
                $product_size_quantity->quantity = $product_size_quantity->quantity + $item->quantity;

                $product_size_quantity->save();
            }
        }

        flash('Return Product Added to Stock Successfully')->success();

        return response()->json([
            'success' => true
        ], Response::HTTP_OK);
    }

    public function history() {
        $return_products = ReturnProduct::with(['product', 'size'])->orderBy('created_at', 'DESC')->get();
        return view('products.history', compact("return_products"));
    }
}
