<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductSizeStock;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with(['category', 'brand'])->get();
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate form data
        $validate = Validator::make($request->all(), [
            'category_id' => 'required|numeric',
            'brand_id' => 'required|numeric',
            'sku' => 'required|string|max:100|unique:products,sku',
            'name' => 'required|string|min:2|max:200',
            'image' => 'required|image|mimes:jpej,jpg,png|max:1024',
            'cost_price' => 'required|numeric',
            'sell_price' => 'required|numeric',
            'year' => 'required',
            'description' => 'required|string|max:200',
            'status' => 'required|numeric',
        ]);

        if($validate->fails()){
            return response()->json([
                'success' => false,
                'errors' => $validate->errors()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        // Store Prduct
        $product = new Product();
        $product->user_id = auth()->id();
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->sku = $request->sku;
        $product->name = $request->name;
        $product->cost_price = $request->cost_price;
        $product->sell_price = $request->sell_price;
        $product->year = $request->year;
        $product->description = $request->description;
        $product->status = $request->status;

        // Upload Image
        if($request->hasFile('image')){
            $image = $request->image;
            $newImage = Str::random(60) . '.'. $image->getClientOriginalExtension();
            $image->storeAs('public/product_images', $newImage);
            $product->image = $newImage;
        }

        // save to database
        $product->save();

        // Store product size stock
        if($request->items){
            foreach(json_decode($request->items) as $item) {
                $stock = new ProductSizeStock();
                $stock->product_id = $product->id;
                $stock->size_id = $item->size_id;
                $stock->location = $item->location;
                $stock->quantity = $item->quantity;
                $stock->save();
            }
        }

        flash('Product Updated Successfully')->success();

        return response()->json([
            'success' => true,
        ], Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::with(['category', 'brand', 'product_stocks.size'])
            ->where('id', $id)
            ->first();

        return view('products.show', compact('product'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::where('id', $id)->with(['product_stocks'])->first();
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //validate form data
        $validate = Validator::make($request->all(), [
            'category_id' => 'required|numeric',
            'brand_id' => 'required|numeric',
            'sku' => 'required|string|max:100|unique:products,sku,'.$id,
            'name' => 'required|string|min:2|max:200',
            'image' => 'nullable|image|mimes:jpej,jpg,png|max:1024',
            'cost_price' => 'required|numeric',
            'sell_price' => 'required|numeric',
            'year' => 'required',
            'description' => 'required|string|max:200',
            'status' => 'required|numeric',
        ]);

        if($validate->fails()){
            return response()->json([
                'success' => false,
                'errors' => $validate->errors()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        // Store Prduct
        $product = Product::findOrFail($id);
        $product->user_id = auth()->id();
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->sku = $request->sku;
        $product->name = $request->name;
        $product->cost_price = $request->cost_price;
        $product->sell_price = $request->sell_price;
        $product->year = $request->year;
        $product->description = $request->description;
        $product->status = $request->status;

        // Upload Image
        if($request->hasFile('image')){
            $image = $request->image;
            $newImage = Str::random(60) . '.'. $image->getClientOriginalExtension();
            $image->storeAs('public/product_images', $newImage);
            $product->image = $newImage;
        }

        // save to database
        $product->save();


        // Delete old stock data
        ProductSizeStock::where('product_id', $id)->delete();

        // Store product size stock
        if($request->items){
            foreach(json_decode($request->items) as $item) {
                $stock = new ProductSizeStock();
                $stock->product_id = $product->id;
                $stock->size_id = $item->size_id;
                $stock->location = $item->location;
                $stock->quantity = $item->quantity;
                $stock->save();
            }
        }

        flash('Product Updated Successfully')->success();

        return response()->json([
            'success' => true,
        ], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        flash('Product deleted successfully')->success();
        return back();
    }

    // handle AJAX REQUEST
    public function getProductsJson() {
        $products = Product::with(['product_stocks.size'])->get();

        return response()->json([
            'success' => true,
            'data' => $products
        ], Response::HTTP_OK);
    }
}
