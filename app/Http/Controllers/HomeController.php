<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Sale;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

// get today - 2015-12-19 00:00:00
$today = Carbon::today();

// get yesterday - 2015-12-18 00:00:00
$yesterday = Carbon::yesterday();

// get tomorrow - 2015-12-20 00:00:00
$tomorrow = Carbon::tomorrow();

$dy  = date('y-m-d', strtotime("yesterday"));


// Money query from yesterday
$yesterday_total_sales = Sale::where('created_at', '>=', $yesterday)->pluck('total_money')->sum();
$yesterday_paid_sales = Sale::where('created_at', '>=', $yesterday)->pluck('paid_money')->sum();
$yesterday_remain_sales = Sale::where('created_at', '>=', $yesterday)->pluck('remain_money')->sum();

// product query from yesterday
$yesterday_total_products = Sale::where('created_at', '>=', $yesterday)->pluck('total_amount')->sum();
$yesterday_paid_products = Sale::where('created_at', '>=', $yesterday)->pluck('received_amount')->sum();
$yesterday_remain_products = Sale::where('created_at', '>=', $yesterday)->pluck('remain_amount')->sum();
      // $sales = Sale::where('created_at', '<=', $today)->where('created_at', '>=', $yesterday)->get();
return view('home')
->with('yesterday_total_sales', $yesterday_total_sales)
->with('yesterday_remain_sales', $yesterday_remain_sales)
->with('yesterday_paid_sales', $yesterday_paid_sales)

->with('yesterday_total_products', $yesterday_total_products)
->with('yesterday_remain_products', $yesterday_remain_products)
->with('yesterday_paid_products', $yesterday_paid_products);
    }

    public function userProfile(){
        $user = auth()->user();
         return view('user_profile')
         ->with('user', $user);
    }

        public function changePassword(Request $request){
            request()->validate([
    'current_password' => 'required',
    'password' => 'required|confirmed',
    'password_confirmation' => 'required|same:password', 
            ]);

        $user = auth()->user()->id;
            $us = User::find($user);
            if ( Hash::check( $request->current_password, $us->password) ) {
                  $us->password = Hash::make($request->password);
                  $us->save();
                session()->flash('success',  'password changed');  
                return redirect()->route('user.profile') ;
            }else{
                session()->flash('error', 'The password is not valid please make sure you type  you password correctly');
                return redirect()->route('user.profile');   
            }
                    }

}
