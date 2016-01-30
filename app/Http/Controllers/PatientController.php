<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\PatientRequest;
use App\Http\Requests\PatientRegRequest;
use App\Http\Controllers\Controller;
use App\ArticleCategory;

use Auth;
use Hash;
use Mail;
use Session;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

    }

    public function login()
    {
        $data = [];
        $data['article'] = ArticleCategory::with( 'articles')->get();

        return view('frontend.pages.patient.login', compact('data'));
    }

    public function postLogin(Request $request){

        $email = $request->get('email');
        $password = $request->get('password');
        $remember_me = true;
        if (Auth::attempt(['email' => $email, 'password' => $password], $remember_me)){
            if(Auth::user()->verified == '1')
                return redirect()->route('patient.dashboard');
            else{
                Session::flash('failed', "Akun anda belum terverifikasi silakan cek email anda.");
                Auth::logout();
            }
        }else{
            Session::flash('failed', "Kombinasi email dan password tidak cocok.");
        }
        
        return redirect()->back();
    }

    public function register()
    {
        //
        $data = array();
        $data['content'] = null;

        $data['list_gender'][0] = 'L';
        $data['list_gender'][1] = 'P';

        $data['article'] = \App\ArticleCategory::with( 'articles')->get();

        return view('frontend.pages.patient.register')->with('data', $data);
    }
    public function post_register(PatientRegRequest $request)
    {
        $role = \App\Role::where('default','1')->first();
        $input = $request->all();
        $password = bcrypt($request->input('password'));
        $input['password'] = $password;
        $input['activation_code'] = str_random(10) . $request->input('email');
        $register = \App\User::create($input);
        $register->password = $password;
        $register->save();
        $register->roles()->attach($role->id);
        $data = [
           'first_name' => $input['first_name'],
           'last_name' => $input['last_name'],
           'code' => $input['activation_code']
        ];
        // $this->sendEmail($data, $input);
        Session::flash('success', "Cek email untuk mengaktivasi akun");
        
        return redirect()->route('patient.register');
    }

    public function sendEmail($data, $input)
    {

        Mail::send('pages.patient.register-email', $data, function($message) use ($input) {

            $message->from('team@dokternet.com', 'DokterNet-Indonesia');
            $message->to($input['email'], $input['first_name'])->subject('Please verify your account registration!');

        });
    }

    public function activate($code, \App\User $patient)
    {
        if ($patient->activateAccount($code)) {
            return 'Akun pasien Anda berhasil diaktivasi';
        }
        return 'Akun pasien Anda gagal diaktivasi';
    }
    public function dashboard()
    {
        return "dashboard";
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('patient.login');
    }
}
