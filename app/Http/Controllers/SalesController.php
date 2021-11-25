<?php

namespace App\Http\Controllers;

use App\Sale;
use App\Stock;
use App\Product;
use App\View\Components\models\sell;
use Dotenv\Result\Success;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Carbon;
use PDF;

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


    public function conv_pdf( $sales ){

$html_table = '
<h2 style="text-align: center; font-family: Hoefler Text;">Sales information </h2>
<table style="border: 1px solid black;
  border-collapse: collapse; width: auto">
  <tr>
    <th style="border: 1px solid black;
  border-collapse: collapse;">#</th>
    <th style="border: 1px solid black;
  border-collapse: collapse;">product</th>
    <th style="border: 1px solid black;
  border-collapse: collapse;">Cost</th>
  <th style="border: 1px solid black;
  border-collapse: collapse;">paid</th>
    <th style="border: 1px solid black;
  border-collapse: collapse;">remain</th>
  <th style="border: 1px solid black;
  border-collapse: collapse;">paid_cost</th>
    <th style="border: 1px solid black;
  border-collapse: collapse;">remain_cost</th>
  <th style="border: 1px solid black;
  border-collapse: collapse;">who</th>
  <th style="border: 1px solid black;
  border-collapse: collapse;">date</th>
  ';
foreach ( $sales as $sale ){
    $html_table .= '
<tr>
    <td style="border: 1px solid black;
  border-collapse: collapse; padding: 3px; text-align:center;">'.$sale->id.'</td>
       <td style="border: 1px solid black;
  border-collapse: collapse; padding: 3px; text-align:center;">'.$sale->product->product_name.'</td>
      <td style="border: 1px solid black;
  border-collapse: collapse; padding: 3px; text-align:center;">'.$sale->product->product_cost.'</td>
   <td style="border: 1px solid black;
  border-collapse: collapse; padding: 3px; text-align:center;">'.$sale->received_amount.'</td>
   <td style="border: 1px solid black;
  border-collapse: collapse; padding: 3px; text-align:center;">'.$sale->remain_amount.'</td>
   <td style="border: 1px solid black;
  border-collapse: collapse; padding: 3px; text-align:center;">'.$sale->paid_money.'</td>
   <td style="border: 1px solid black;
  border-collapse: collapse; padding: 3px; text-align:center;">'.$sale->remain_money.'</td>
   <td style="border: 1px solid black;
  border-collapse: collapse; padding: 3px; text-align:center;">'.$sale->who_buys.'</td>
   <td style="border: 1px solid black;
  border-collapse: collapse; padding: 3px; text-align:center;">'.date( "Y-m-d, h:i:s A", strtotime( $sale->created_at )).'</td>

  </tr>';
}
        $html_table .= '</table>';


        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML( $html_table );
        return $pdf->stream();
    }



    public function deletedSales(){
       $sales = Sale::onlyTrashed()
                ->where('id', '>', -2)
                ->paginate(10);
         return view('sales.deleted_sales')
         ->with('sales', $sales);

    }




    public function deletedFromToSales(Request $request){

              $rules = array(
                'from_date' => ['required'],
                'to_date' => ['required'],
              );
              $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
               session()->flash('error', 'please make sure you fill all the data correctly and try again');
               return redirect()->route('sales.deleted');
        }elseif (date('Y-m-d', strtotime($request->from_date)) > date('Y-m-d', strtotime($request->to_date))) {
                    session()->flash('error', 'to date is smaller than from date');
               return redirect()->route('sales.deleted');
              }else{
                        $datas = Sale::onlyTrashed()
        ->where('created_at', '>', date('Y-m-d', strtotime($request->from_date)) )
        ->where( 'created_at', '<', date('Y-m-d', strtotime($request->to_date)) );
        $datas->forceDelete();
            session()->flash('success', 'successfully delete the datas');
        return redirect()->route('sales.deleted');
              }

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
    if ($prev_data->amount < $received ) {
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

    public function salesUpdateAjax(Request $request)
    {
        $product_cost = Product::find( $request->product );
$product_cost = $product_cost->product_cost;
$user =  auth()->user()->id ;
$total = $request->total_amount;
$received = $request->received_amount;
$sellone = Sale::where('id', $request->sellId )->first();


        if( Sale::find( $request->sellId )->product_id != $request->product ){
            $prev_data = Stock::where( 'product_id', Sale::find( $request->sellId )->product_id  )->first();
            $pre_product_id = Sale::find( $request->sellId )->product_id;
            Stock::where('product_id', $pre_product_id )->update([
            'amount' => $prev_data->amount + $sellone->total_amount,
            ]);

            $sell = Sale::where('id', $request->sellId )->update([
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

        $st = Stock::where('product_id', $request->product )->update([
            'amount' => ( Stock::where('product_id', $request->product )->first()->amount - $total  ),
        ]);


         }else{

            $prev_data = Stock::where( 'product_id', $request->product )->first();
            $rules = array(
            'total_amount' => ['required', 'integer', 'min:1'],
            'received_amount' => ['required', 'integer', 'min:1'],
                     );
        $error = Validator::make($request->all(), $rules);
        if ($error->fails()) {
                return response()->json(['error' => $error->errors()->all()]);
        }else{
                if( $total < $received ){
                    return response()->json(['error' => 'Total is less Than Expected' ]);
                    }

if( $prev_data == null ){
    return response()->json(['error' => 'stock has no product of this type' ]);
}else{
    if (($prev_data->amount + $sellone->total_amount) <= $received ) {
        return response()->json(['error' => 'stock has '.$prev_data->amount.' only' ]);
    }else{

        $sell = Sale::where('id', $request->sellId )->update([
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


    $st = Stock::where('product_id', $request->product )->update([
        'amount' => ( ( $prev_data->amount + $sellone->total_amount ) - $total  ),
    ]);
        }
    }
        }
         }
         if( $sell and $st ){
            return response()->json(['success' => 'data updated' ]);
         }else{
            return response()->json(['error' => $request->total_amount ]);
         }
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

    public function salesDeleteAjax( Request $request ){
//        $query = Sale::where('id', $request->id )->first();
//
//        $st = Stock::where('product_id', $request->product );
//
//        if ( $query ){
//            $out = response()->json(['success' => $query ]);
//        }else{
//            $out =  response()->json(['fail' => $request ]);
//        }
//        return $out;
        $query = Sale::where('id', $request->id )->first();
        $sales_product_amount = Sale::where('id', $request->id )->first()->total_amount;
        $stock_product_amount = Stock::where('product_id', $query->product_id)->first()->amount;
        Stock::where('product_id', $query->product_id)->update([
            'amount' => ( $stock_product_amount + $sales_product_amount )
        ]);
        $query->delete();
        if ( $query ){
            $out =  response()->json(['success' => 'deleted successfully' ]);
        }else{
            $out =  response()->json(['fail' => 'fail to delete the data' ]);
        }
        return $out;
    }


    public function sales_pdf_data_from_to( Request $request ){

              $rules = array(
                'from_date' => ['required'],
                'to_date' => ['required'],
              );
              $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
               session()->flash('error', 'please make sure you fill all the data');
               return redirect()->route('sales.index');
        }elseif (date('Y-m-d h:i:s A', strtotime($request->from_date)) > date('Y-m-d, h:i:s A', strtotime($request->to_date))) {
                    session()->flash('error', 'to date is smaller than from date');
               return redirect()->route('sales.index');
              }else{
                   $datas = Sale::where('created_at', '>=', date('Y-m-d h:i:s', strtotime($request->from_date)) )
        ->where( 'created_at', '<=', date('Y-m-d h:i:s', strtotime($request->to_date)) )->orderBy('id', 'desc')->get();

                    return $this->conv_pdf( $datas );
              }
    }

}
