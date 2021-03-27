<?php

namespace App\Http\Controllers;

use App\Ingridient;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        $ingridients = Ingridient::all();
        return view('product.all-products')
        ->with( 'products', $products )
        ->with('ingridients', $ingridients);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
                $rules = array(
                    'product_name' => ['required', 'unique:products'],
                    'product_cost' => ['required'],
                    );
            $error  =  Validator::make( $request->all(), $rules );
            if ($error->fails()) {
                return response()->json(['error' => $error->errors()->all()]);
                    }else {
                        $prod = Product::create([
                            'product_name' => $request->product_name,
                            'product_cost' => $request->product_cost,
                        ]);
                        $prod->ingridients()->sync( $request->ingr_arr );
                return response()->json(['success' => 'data saved successfully']);
                }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
