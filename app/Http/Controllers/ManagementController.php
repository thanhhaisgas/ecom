<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\User;
use Crypt;
class ManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
        public function index()
    {
        //
        $userList = User::all();
      
        return view('layouts.admin.user.list')->with('userList',$userList);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('layouts.admin.user.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        //
        $add = new User;
        $add->name=$request->displayname;
        $add->email=$request->email;  
        $add->password= Crypt::encrypt($request->password);
        $add->level = $request->cbright;
        
        $add->save();  
        return redirect('administrator/user');
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
        $user = User::find($id);
        try {
            $decrypted = Crypt::decrypt($user->password);
        } catch (\Exception $e) {
            
        }
        return view('layouts.admin.user.edit')->with(['user'=>$user,'decrypted'=>$decrypted]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        //
        $user = User::find($id);
        $user->name= $request->displayname;
        $user->password = Crypt::encrypt($request->password);
        $user->save();
        return redirect('administrator/user');
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
        echo $id;
        $user = User::findOrFail($id);
        $user->delete();
        return redirect('administrator/user');
    }
}
