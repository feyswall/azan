<?php

namespace App\Http\Controllers;

use App\Stock;
use App\StockTrace;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StocksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stock_product = Stock::all();
        $stockHist = StockTrace::all();
        $one = Stock::where('id', '>', '0')->first();
        return view('stock.all-in-stock')
        ->with('stocks', $stock_product )
        ->with('stockHist', $stockHist );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('stock.add-into-stock');
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
            'product_id' => ['required'],
            'amount' => ['required', 'integer', 'min:1'],
            );
     $request->validate( $rules );
     $res = Stock::where('id','>', '-2' )->pluck('product_id');
          if( $res->contains($request->product_id) ){
              $prev_data = Stock::where( 'product_id', $request->product_id )->first();
                Stock::where('product_id', $request->product_id )->update([
                    'amount' => ( $request->amount + $prev_data->amount ),
                ]);
                session()->flash('stockCreate','stock updated and saved' );
          }else{
            Stock::create([
                'product_id' => $request->product_id,
                'user_id' => auth()->user()->id,
                'amount' => $request->amount,
            ]);
            session()->flash('stockCreate','stock created and saved' );
          }

            StockTrace::create([
                'product_id' => $request->product_id,
                'user_id' => auth()->user()->id,
                'amount' => $request->amount,
            ]);

            return redirect()->route('stock.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function show(Stock $stock)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function edit(Stock $stock)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Stock $stock)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function destroy(Stock $stock)
    {
        //
    }
}
