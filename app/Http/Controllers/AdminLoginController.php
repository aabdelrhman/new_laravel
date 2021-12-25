<?php

namespace App\Http\Controllers;

use App\Http\Requests\adminLogin;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Socialite;

class AdminLoginController extends Controller
{

    function dashboard(){
        return view('Admin.dashboard');
    }


    function getLogin(){
        return view('Auth_admin.login');
    }

    function adminLogin(adminLogin $request){
        if(auth()->guard('admin')->
        attempt(['email' => $request->email,
        'password' => $request->password] ,
        $request->get('remember'))){
            return redirect()->route('Dashboard') ;
        }else{
            return redirect()->route('getLogin')->with(['message' => 'هناك خطا بالبيانات']);
        }
    }

    // google login
    function redirect_login($driver){
        return Socialite::driver($driver)->redirect();
    }

    function callback(){
        try {
            $info = Socialite::driver('google')->user();
            $admin = Admin::where('google_id' , $info->id)->first();
            if(!empty($admin)){
                Auth::guard('admin')->login($admin);
            }else{
                $admin = Admin::create([
                    'name' => $info->name,
                    'email' => $info->email,
                    'google_id' => $info->id,
                    'password' => md5(rand(1 ,1000)),
                ]);
                Auth::guard('admin')->login($admin);
            }
            return redirect()->route('Dashboard');
        } catch (\Throwable $th) {
            return $th;
        }
    }

    function logout(){
        Auth::guard('admin')->logout();
        return redirect()->route('getLogin');
    }
}
