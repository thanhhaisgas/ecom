<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;
Use App\User;
Use App\Authen;
use DB;
use Crypt;
use Hash;
use Push;
use App\Http\Requests\AuthenRequest;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if(session()->has('login')){
            return back()->withInput();
        }else{
            return view('client.page.login');
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
    public function store(AuthenRequest $request)
    {
		

           $au = new Authen($request->email);
            if($au->Login($request->key,$request->password1)){
                return redirect('pay');
            }else{
                session()->flash('errorlogin','Email Or Password wrong');
                return redirect('login_user');
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
        //
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
        //
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

    public function logout(){
        $au = new Authen($request->email);
        $au->Logout();
        return redirect('/');
    }
   
}
