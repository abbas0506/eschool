<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

use App\Models\User;
use Exception;

class AuthController extends Controller
{
    //
    public function signup(Request $request)
    {
        //signup  process
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'password' => 'required',

        ]);

        try {

            $user = User::create([
                'name' => $request->name,
                'phone' => $request->phone,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            Auth::login($user);

            return redirect('/');
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required',
            'password' => 'required',

        ]);

        // 
        if (Auth::attempt($credentials)) {
            return redirect('login/as');
        } else {
            return redirect()->back()->with(['warning' => 'User credentials incorrect !']);
        }
    }
    // login step2
    public function loginAs(Request $request)
    {
        $request->validate([
            'session_id' => 'required_if:role,admin,incharge,hod,teacher,dep',
        ]);


        if (Auth::user()->hasRole($request->role)) {
            // save selected semester id for entire session
            if (Auth::user()->hasAnyRole('super', 'admin', 'hod', 'incharge', 'teacher', 'dep')) {
                session([
                    'session_id' => $request->session_id,
                ]);

                // session()->put(['session_id' => $request->session_id]);
            }
            return redirect($request->role);
        } else
            return redirect('/');
    }


    public function verify_step2(Request $request)
    {
        //get 2nd factor secret code sent to gmail
        //if matched, redirect to user dashboard

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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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

    public function signout()
    {
        //destroy session
        session()->flush();
        Auth::logout();
        return redirect('/');
    }

    public function changePassword(Request $request)
    {
        $user = Auth::user();
        //change password process
        $request->validate([
            'current' => 'required',
            'new' => 'required',
        ]);

        try {

            if (Hash::check($request->current, $user->password)) {
                $user->password = Hash::make($request->new);
                $user->save();
                return redirect()->back()->with('success', 'successfuly changed');
            } else {
                //password not found
                return redirect()->back()->with('warning', 'Oops, something wrong!');;
            }
        } catch (Exception $e) {
            return redirect()->back()
                ->withErrors($e->getMessage());
            // something went wrong
        }
    }
}
