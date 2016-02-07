<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\ClinicUpdateRequest;
use App\Http\Controllers\Controller;

use Auth;
use Session;

use App\User;
use App\Clinic;
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

    public function dashboard( Request $request )
    {
        $data = [];
        $data['article'] = ArticleCategory::with( 'articles' )->get();
        $data['content'] = Auth::user()->clinic;

        return view( 'frontend.pages.clinic.dashboard', compact( 'data' ) );
    }

    public function update( ClinicUpdateRequest $request )
    {
        Clinic::where( 'user_id', Auth::user()->id )->update( [
            'name'      => $request->name,
            'address'   => $request->address,
            'telephone' => $request->telephone,
            'email'     => $request->email,
        ] );

        $data = User::find( Auth::user()->id );
        $data->email = $request->email;
        $data->save();

        Session::flash( 'success', "Data klinik berhasil disimpan!" );
        return redirect()->route( 'clinic.dashboard' );
    }

    public function changePassword()
    {
        $data = [];
        $data['article'] = ArticleCategory::with( 'articles' )->get();

        return view( 'frontend.pages.clinic.change-password', compact( 'data' ) );
    }

    public function postChangePassword( Request $request )
    {
        $old = $request->old;
        $new = $request->new;
        $confirm = $request->confirm;

        if ( $old != "" && $new != "" && $confirm != "" ) {
            if ( $new == $confirm ) {
                if ( password_verify( $old, Auth::user()->password ) ) {
                    $data = User::find( Auth::user()->id );
                    $data->password = bcrypt( $new );
                    $data->save();
                    Session::flash( 'success', "Password baru berhasil disimpan!" );
                }
                else {
                    Session::flash( 'failed', "Password lama salah." );
                }
            }
            else {
                Session::flash( 'failed', "Konfirmasi password baru tidak cocok." );
            }
        }
        else {
            Session::flash( 'failed', "Semua kolom harus diisi." );
        }

        return redirect()->back();
    }

    public function doctor()
    {
        $data = [];
        $data['article'] = ArticleCategory::with( 'articles' )->get();

        return view( 'frontend.pages.clinic.dashboard', compact( 'data' ) );
    }

    public function appointment()
    {
        $data = [];
        $data['article'] = ArticleCategory::with( 'articles' )->get();

        return view( 'frontend.pages.clinic.dashboard', compact( 'data' ) );
    }

    public function report()
    {
        $data = [];
        $data['article'] = ArticleCategory::with( 'articles' )->get();

        return view( 'frontend.pages.clinic.dashboard', compact( 'data' ) );
    }
}
