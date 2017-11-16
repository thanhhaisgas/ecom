<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Auth;
use DB;
use Session;
use Crypt;

class Authen extends  Authenticatable{




    
    protected $table = 'users';
    
    protected $fillable = [
        'name', 'email', 'password','level',
    ];
    protected $hidden = [
        'password'
    ];

    public function __construct($email){
        $this->email=$email;

    }
    public function  __destruct(){
 
    }
    public function getAuthIdentifier()
    {
           return $this->email;
       
    }
    public function getAuthPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }
    
    public function Login($key,$password){
        
    
            $user = DB::table('users')->where('email',$this->getAuthIdentifier())->first();
            $decrypted = Crypt::decrypt($user->password);
            if($password == md5("$decrypted$key")){
                    session()->put('login',$user);
                    return true;
              //  return false;
            }
            return false;

       
        
     
    }
    public function Logout(){
        if(session()->has('login')){
            session()->forget('login');
        }
        return null;
    }

    public function CheckAccount(){
        if(session()->has('login')!=null){
            return true;
        }
        return false;
    }

    public function GetData(){
        return session()->get('login');
    }


}

?>