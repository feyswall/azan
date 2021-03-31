<?php

namespace App\Http\Controllers;

use App\Sale;
use App\Stock;
use App\Product;
use Dotenv\Result\Success;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SalesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sales = Sale::where('id', '>', '-2')->orderBy('id', 'desc')->paginate(10);
        return view('sales.all-sell')->with('sales', $sales);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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
            'total_amount' => ['required', 'integer', 'min:1'],
            'received_amount' => ['required', 'integer', 'min:1'],
        );
        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
                return response()->json(['error' => $error->errors()->all()]);
        }

$product_cost = Product::find( $request->product );
$product_cost = $product_cost->product_cost;
$user =  auth()->user()->id ;
$total = $request->total_amount;
$received = $request->received_amount;
if( $total < $received ){
    return response()->json(['error' => 'Total is less Than Expected' ]);
}

$prev_data = Stock::where( 'product_id', $request->product )->first();
if( $prev_data == null ){
    return response()->json(['error' => 'stock has no product of this type' ]);
}else{
    if ($prev_data->amount <= $received ) {
        return response()->json(['error' => 'stock has '.$prev_data->amount.' only' ]);
    }else{
        $sell = Sale::create([
            'total_amount' => $total,
            'received_amount' => $received,
            'remain_amount' => ( $total - $received ),

            'paid_money' => (  $received * $product_cost ),
            'remain_money' => ( ($total - $received)*$product_cost ),
            'total_money' => ( $total*$product_cost ),
            'user_id' => $user,
            'product_id' => $request->product,
            'who_buys' => $request->who_buys,
    ]);


    Stock::where('product_id', $request->product )->update([
        'amount' => (  $prev_data->amount - $total  ),
    ]);
     if( $sell ){
        return response()->json(['success' => $request->total_amount ]);
     }else{
        return response()->json(['error' => $request->total_amount ]);
     }
    }
}

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function show(Sale $sale)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function edit(Sale $sale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sale $sale)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Sale  $sale
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sale $sale)
    {
        //
    }
}
