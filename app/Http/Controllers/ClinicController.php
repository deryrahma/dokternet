<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\ClinicUpdateRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\ClinicRegisterRequest;

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
    public function register()
    {
        //
        $data = array();
        $data['content'] = null;

        $data['list_gender'][0] = 'L';
        $data['list_gender'][1] = 'P';
        $data['city'] = \App\City::all();
        $data['specialization'] = \App\Specialization::all();

        $data['article'] = \App\ArticleCategory::with( 'articles')->get();

        return view('frontend.pages.clinic.register')->with('data', $data);
    }
    public function post_register(ClinicRegisterRequest $request)
    {
        $input = $request->all();
        $password = bcrypt($request->input('password'));
        $input['password'] = $password;
        $input['activation_code'] = str_random(10) . $request->input('email');
        $register = \App\User::create($input);
        $register->password = $password;
        $register->save();
        $register->roles()->attach(2);
        
        $clinic = \App\Clinic::create([
            'user_id' => $register->id,
            'name' => $input['name'],
            'city_id' => $input['city_id']
        ]);
        Session::flash('success', "Jika dalam kurun waktu 24 jam Anda tidak menerima email dari kami, Anda dapat menghubungi kami melalui email di <a href='mailto:support@dokternet.com'>support@dokternet.com</a>");
        
        return redirect()->route('clinic.register');
    }
    public function education($id)
    {
        $doctor = \App\Doctor::find($id);
        return view('frontend.pages.clinic.doctor.education', compact('doctor'));
    }
    public function educationStore(Request $request, $id)
    {
        \App\DoctorEducation::create([
            'doctor_id' => $id,
            'year' => $request->input('year'),
            'name' => $request->input('name')
            ]);
        Session::flash('success', "Data pendidikan berhasil ditambahkan.");
        return redirect()->route('clinic.doctor.show', [$id]);
    }
    public function educationDestroy($id)
    {
        $data = \App\DoctorEducation::find($id);
        $doctor_id = $data->doctor_id;
        $data->delete();
        Session::flash('success', "Data pendidikan berhasil dihapus.");
        return redirect()->route('clinic.doctor.show', [$doctor_id]);
    }
    public function experience($id)
    {
        $doctor = \App\Doctor::find($id);
        return view('frontend.pages.clinic.doctor.experience', compact('doctor'));
    }
    public function experienceStore(Request $request, $id)
    {
        \App\DoctorExperience::create([
            'doctor_id' => $id,
            'name' => $request->input('name')
            ]);
        Session::flash('success', "Data pengalaman berhasil ditambahkan.");
        return redirect()->route('clinic.doctor.show', [$id]);
    }
    public function experienceDestroy($id)
    {
        $data = \App\DoctorExperience::find($id);
        $doctor_id = $data->doctor_id;
        $data->delete();
        Session::flash('success', "Data pengalaman berhasil dihapus.");
        return redirect()->route('clinic.doctor.show', [$doctor_id]);
    }
}
