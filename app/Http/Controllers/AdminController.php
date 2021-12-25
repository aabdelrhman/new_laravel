<?php

namespace App\Http\Controllers;

use App\Http\Requests\insertAdmin;
use App\Mail\verificationmail;
use App\Models\Admin;
use App\Models\adminVerify;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admins = Admin::with('Roles')->where('id' , '!=' , Auth::user()->id)->get();
        return view('Admin.Admins.index' , compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        return view('Admin.Admins.create' , compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(insertAdmin $request)
    {
        try {
            DB::beginTransaction();
            $admin = Admin::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->name) ,
            ]);
            $admin -> syncRoles($request->role);
            $token = Str::random(64);
            adminVerify::create([
                'admin_id' => $admin->id,
                'token' => $token
            ]);
            Mail::to($request->email)->send(new verificationmail($token));  //verification email
            // Mail::send('Admin.Emails.emailVerificationEmail', ['token' => $token], function($message) use($request){
            //     $message->to($request->email);
            //     $message->subject('Email Verification Mail');
            // });
            DB::commit();
            return redirect()->route('admins.index')->with('success' , __('messages.success add'));
        } catch (\Throwable $th) {
            DB::rollback();
            return redirect()->route('admins.index')->with('error' , __('messages.error add'));
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
    public function edit(Admin $admin)
    {
        $admin->load('Roles');
        $roles = Role::all();
        return view('Admin.Admins.edit' , get_defined_vars());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Admin $admin)
    {
        try {
            $request->validate([
                'Roles' =>  'required|exists:roles,id|array|min:1',
            ]);
            $admin -> syncRoles($request -> Roles);
            return redirect()->route('admins.index')->with('success' , __('messages.success update'));
        } catch (\Throwable $th) {
            return redirect()->route('admins.index')->with('error' , __('messages.error update'));
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
        $admin -> delete();
        return redirect()->route('admins.index')->with('success' , __('messages.success delete'));
    }

    public function verifyAccount($token)
    {
        $verifyadmin = adminVerify::where('token', $token)->first();
        $message = 'Sorry your email cannot be identified.';
        if(!is_null($verifyadmin) ){
            $admin = $verifyadmin->load('admin');
        if($admin->admin->is_email_verified == 0) {
            $admin->admin->is_email_verified = 1;
            $admin->admin->save();
            $message = "Your e-mail is verified. You can now login.";
        } else {
            $message = "Your e-mail is already verified. You can now login.";
        }
        }
            return redirect()->route('getLogin')->with('message', $message);
        }
    }
