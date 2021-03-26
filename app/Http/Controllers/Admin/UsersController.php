<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use App\Role;
use Hamcrest\Arrays\IsArray;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(  )
    {
        $data = User::where('id', '!=', auth()->id())->get();
        return view( 'manage-users')->with('datas', $data );
    }

    public function deleteAjax( Request $request ){
        $query = User::find( $request-> id );
        $query->roles()->detach();
        $query->delete();
        if ( $query ){
            $out = response()->json(['success' => 'succeed in that' ]);
        }else{
            $out =  response()->json(['fail' => 'something just isnt right']);
        }
        return $out;
    }



    public function updateAjax( Request $request, $id ){
        $flight = User::find( $id );

    if( $flight->email == $request->email ){
                if( $request->password == null ){
                    $rules = array(
                        'name' => ['required', 'string', 'max:255'],
                        'role' => ['required']
                );
                }else{
                    $rules = array(
                        'name' => ['required', 'string', 'max:255'],
                        'password' => ['string', 'min:8', 'confirmed'],
                        'role' => ['required']
                );
                }

    }else{
        if( $request->password == null ){
            $rules = array(
                'name' => ['required', 'string', 'max:255'],
                'role' => ['required']
        );
        }else{
            $rules = array(
                'name' => ['required', 'string', 'max:255'],
                'password' => ['string', 'min:8', 'confirmed'],
                'role' => ['required']
        );
        }
    }

    $error  =  Validator::make( $request->all(), $rules );
    if ($error->fails()) {
        return response()->json(['error' => $error->errors()->all()]);
    }else {

            if( $flight->email == $request->email ){
                $flight->name = $request->name;
            }else{
                $flight->name = $request->name;
                $flight->email = $request->email;
            }
            if( $request->password != null ){
                $flight->password = Hash::make( $request->password );
            }
            $flight->save();

        $flight->roles()->sync( $request->role );
        return response()->json(['success' => 'created successfully']);
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
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
                'role' => ['required', 'string']
        );
        $error  =  Validator::make( $request->all(), $rules );
        if ($error->fails()) {
            return response()->json(['error' => $error->errors()->all()]);
        }else {
            $flight = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' =>Hash::make( $request->password ),
            ]);
            $userRole = Role::where('name', $request->role )->first();
            $flight->roles()->attach( $userRole );
            return response()->json(['success' => 'created successfully']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
