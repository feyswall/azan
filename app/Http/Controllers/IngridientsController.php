<?php

namespace App\Http\Controllers;

use App\Ingridient;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class IngridientsController extends Controller
{


    public function retrieve(  $id )
    {
        $ingridient  = Ingridient::onlyTrashed()->find( $id )->restore();
        return redirect()->route('ingridient.index');
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $trashes = Ingridient::select("*")
            ->onlyTrashed()
            ->get();


        $datas = Ingridient::select("*")
            ->where("id", ">", "-2")
            ->orderBy("id", 'desc')
            ->get();
        return view('ingridient.ingridientIndex')
            ->with('datas', $datas )
            ->with('trashes', $trashes );
    }


    public function deleteAjax( Request $request ){
        $query = Ingridient::find( $request-> id )->delete();
        if ( $query ){
            $out = response()->json(['success' => 'succeed in that' ]);
        }else{
            $out =  response()->json(['fail' => 'something just isnt right']);
        }
        return $out;
    }



    public function updateAjax( Request $request ){
        $rules = array(
            'ingridient_name' => ['required', 'string', 'max:100', 'min:2','unique:ingridients'],
        );
        $error = Validator::make($request->all(), $rules);


        if ($error->fails()) {
            return response()->json(['error' => $error->errors()->all()]);
        }else {
            $ingr = Ingridient::find( $request->inId )->update(['ingridient_name' => $request->ingridient_name]);
            if ( $ingr ) {
                return response()->json(['success' => $ingr]);
            }else{
                return response()->json(['error' => $ingr]);
            }
            $data = Ingridient::all();
            return response()->json(['success' => 'created successfully', 'data' => $data  ]);
        }

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
