<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
        return view('home');
    }

    public function userProfile(){
        $user = auth()->user();
         return view('user_profile')
         ->with('user', $user);
    }

        public function changePassword(Request $request){
            request()->validate([
    'current-password' => 'required',
    'password' => 'required|same:password',
    'password_confirmation' => 'required|same:password', 
            ]);

        $user = auth()->user()->id;
            $us = User::find($user);
                  $us->password = Hash::make($request->password);
                  $us->save();
                session()->flash('success',  'password changed');  
                return redirect()->route('user.profile') ;
                    }

}
