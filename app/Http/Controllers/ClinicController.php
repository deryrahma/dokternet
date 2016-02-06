<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth;
use Session;

use App\ArticleCategory;

class ClinicController extends Controller
{
    public function login()
    {
        $data = [];
        $data['article'] = ArticleCategory::with( 'articles' )->get();

        return view( 'frontend.pages.clinic.login', compact( 'data' ) );
    }

    public function postLogin( Request $request )
    {
        if ( Auth::attempt( ['email' => $request->get( 'email' ), 'password' => $request->get( 'password' )], true ) ) {
            if ( Auth::user()->verified == '1' ) {
                if ( Auth::user()->roles->first()->level == '4' ) {
                    return redirect()->route( 'clinic.dashboard' );
                }
                else {
                    Session::flash( 'failed', "Halaman ini hanya untuk user klinik. Silakan gunakan halaman yang tepat sesuai dengan hak akses anda (pasien/dokter).");
                    Auth::logout();
                }
            }
            else {
                Session::flash( 'failed', "Akun anda belum terverifikasi. Silakan cek email anda.");
                Auth::logout();
            }
        }
        else {
            Session::flash( 'failed', "Kombinasi email dan password tidak cocok." );
        }

        return redirect()->back();
    }

    public function dashboard()
    {
        $data = [];
        $data['article'] = ArticleCategory::with( 'articles' )->get();

        return view( 'frontend.pages.clinic.dashboard', compact( 'data' ) );
    }
}
