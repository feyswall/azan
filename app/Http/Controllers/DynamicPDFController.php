<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Sale;
use PDF;

class DynamicPDFController extends Controller
{
    public function index(){
    	$get_sales_data = $this->get_sales_data();
    	return view('dynamic_pdf');
    }

    public function get_sales_data(){
    	$all_datas = Sale::where('id', '>', "-2")
    	 ->limit(10)
    	 ->get();
    	return $all_datas;
    }

    public function conv_pdf(){
    	$pdf = \App::make('dompdf.wrapper');
    	$pdf->loadHTML('<h1>Test</h1>');
    	return $pdf->stream();
    }
}
