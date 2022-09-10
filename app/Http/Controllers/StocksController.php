<?php

namespace App\Http\Controllers;

use App\Models\ProductSizeStock;
use App\Models\ProductStock;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class StocksController extends Controller
{
    public function stock() {
        return view('stocks.stock');
    }

    public function stockSubmit(Request $request) {
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

        // stock store
        foreach($request->items as $item) {

            // somehow $item returning value as associative array, so I needed to typcast $item as an object in order to use -> notaion on $item.
            $item = (object) $item;


            if($item->quantity && $item->quantity>0) {
                $new_item = new ProductStock();
                $new_item->product_id = $request->product_id;
                $new_item->date = $request->date;
                $new_item->status = $request->stock_type;
                $new_item->size_id = $item->size_id;
                $new_item->quantity = $item->quantity;
                $new_item->save();

                // Update Product Stock Size
                $product_size_quantity = ProductSizeStock::where('product_id', $request->product_id)
                                        ->where('size_id', $item->size_id)
                                        ->first();
                if($request->stock_type == ProductStock::STOCK_IN) {
                    // Add to Stock
                    $product_size_quantity->quantity = $product_size_quantity->quantity + $item->quantity;
                } else {
                    // Sub from Stock
                    $product_size_quantity->quantity = $product_size_quantity->quantity - $item->quantity;
                }
                $product_size_quantity->save();
            }
        }

        flash('Stock Updated Successfully')->success();

        return response()->json([
            'success' => true
        ], Response::HTTP_OK);
    }

    public function history() {
        $stocks = ProductStock::with(['product', 'size'])->orderBy('created_at', 'DESC')->get();
        return view('stocks.history', compact("stocks"));
    }

}
