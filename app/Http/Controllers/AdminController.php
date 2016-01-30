<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use Session;

class AdminController extends Controller
{
    /**
     * Display administrator main page/dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view( 'pages.admin.index' );
    }
    public function login(){

    	return view( 'pages.admin.auth.login' );
    }
    public function postlogin(Request $request)
    {
    	$email = $request->get('email');
        $password = $request->get('password');
        $remember_me = true;
        if (Auth::attempt(['email' => $email, 'password' => $password], $remember_me)){
            if(Auth::user()->roles->first()->level=='1')
                return redirect()->route('admin.dashboard');
            else{
            	Auth::logout();
            }
        }else{
            Session::flash('failed', "Kombinasi email dan password tidak cocok.");
        }
        
        return redirect()->back();
    }
    public function logout()
    {
    	Auth::logout();
    	return redirect()->route('admin.login');
    }
}
