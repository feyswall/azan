<?php

namespace App\Http\Controllers;

use App\Ingridient;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class IngridientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = Ingridient::select("*")
            ->where("id", ">", "-2")
            ->orderBy("id", 'desc')
            ->get();
        return view('ingridient.ingridientIndex')->with('datas', $datas );
    }

    public function ajaxIndex(){
        $datas = Ingridient::select("*")
            ->where("id", ">", "-2")
            ->orderBy("id", 'desc')
            ->get();
        return response()->json( $datas );
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
            'ingridient_name' => ['required', 'string', 'max:100', 'min:4','unique:ingridients'],
        );

        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['error' => $error->errors()->all()]);
        }else {
            $flight = Ingridient::create([
                'ingridient_name' => $request->ingridient_name,
            ]);
            $data = Ingridient::all();
            return response()->json(['success' => 'created successfully', 'data' => $data  ]);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Ingridient  $ingridient
     * @return \Illuminate\Http\Response
     */
    public function show(Ingridient $ingridient)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ingridient  $ingridient
     * @return \Illuminate\Http\Response
     */
    public function edit(Ingridient $ingridient)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ingridient  $ingridient
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ingridient $ingridient)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ingridient  $ingridient
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ingridient $ingridient)
    {
        //
    }
}
