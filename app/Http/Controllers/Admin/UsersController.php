<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use RealRashid\SweetAlert\Facades\Alert;

use App\Models\User;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());

        $rules = [
            'username' => 'required|unique:users',
            'lastname' => 'required',
            'firstname' => 'required',
            'email' => 'required|email|unique:users',
            'phone_number' => 'required',
        ];

        $v = Validator::make($request->all(), $rules);

        if( $v->fails() ) {

            // return back()->with('errors', $v->messages()->all()[0])->withInput();
            Alert::error('Error Title', 'Error Message');
            return redirect()->back()->withInput()->withErrors($v);

        }else{

            $user                   = new User;
            $user->username          = $request->username;
            $user->lastname          = $request->lastname;
            $user->firstname        = $request->firstname;
            $user->email            = $request->email;
            $user->phone_number     = $request->phone_number;
            $user->gender           = "";
            $user->password         = Hash::make($request->password);

            if( $user->save() ) {

                Alert::success('Success Title', 'Information Save Successfully');
                return redirect()->route('users.index');
            }
        }




    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // dd($id);
        $user = User::where('id', '=', $id)->first();

        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'username' => 'required',
            'lastname' => 'required',
            'firstname' => 'required',
            'email' => 'required|email',
            'phone_number' => 'required',
        ];

        $v = Validator::make($request->all(), $rules);

        if( $v->fails() ) {

            return back()->with('errors', $v->messages()->all()[0])->withInput();
            // Alert::error('Error Title', 'Error Message');
            // return redirect()->back()->withInput()->withErrors($v);

        }else{

            $user                   = User::findOrFail($id);
            $user->username         = $request->username;
            $user->lastname         = $request->lastname;
            $user->firstname        = $request->firstname;
            $user->email            = $request->email;
            $user->phone_number     = $request->phone_number;
            $user->gender           = "";
            $user->password         = ($request->password) ? Hash::make($request->password) : $user->password;

            if( $user->save() ) {

                Alert::success('Success Title', 'Information Updated Successfully');
                return redirect()->route('users.index');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
