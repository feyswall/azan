<?php

namespace App\Http\Controllers;

use App\Damage;
use App\Stock;
use Illuminate\Http\Request;

class DamagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('stock.damaged_goods');
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

        Damage::create([
            'product_id' => $request->product_id,
            'amount' => $request->amount,
        ]);

        $prev_data = Stock::where( 'product_id', $request->product_id )->first();
        if( $prev_data == null ){
            session()->flash('damagedError','There isnt any product in Stock' );
        }else{
            if( $prev_data->amount > $request->amount ){
                Stock::where('product_id', $request->product_id )->update([
                    'amount' => ( $prev_data->amount - $request->amount  ),
                ]);
                session()->flash('damaged','The data was successfully saved' );
             }else{
                session()->flash('damagedError','There isnt enough products' );
             }

            return redirect()->route('damaged.create');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Damage  $damage
     * @return \Illuminate\Http\Response
     */
    public function show(Damage $damage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Damage  $damage
     * @return \Illuminate\Http\Response
     */
    public function edit(Damage $damage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Damage  $damage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Damage $damage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Damage  $damage
     * @return \Illuminate\Http\Response
     */
    public function destroy(Damage $damage)
    {
        //
    }
}
