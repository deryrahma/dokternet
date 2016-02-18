<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\ReservationCompleteRequest;

use Session;
use Response;
use Input;
use Auth;
use Mail;

use App\ArticleCategory;
use App\Reservation;
use App\Schedule;
use App\User;

class ReservationController extends Controller
{
  public function schedule( $doctor_id )
  {
    $data = [];
    $data['article'] = ArticleCategory::with( 'articles')->get();
    $data['schedule'] = [];

    for ( $i = 0; $i <= 7; $i++ ) {
      $data['schedule'][$i] = [];
    }

    $schedules = Schedule::where( 'doctor_id', $doctor_id )
                         ->whereBetween( 'date', array( date( "Y-m-d" ), date( "Y-m-d", strtotime( "+1 week" ) ) ) )
                         ->orderBy( 'date', 'asc' )
                         ->orderBy( 'schedule_start', 'asc' )
                         ->get();
    foreach ( $schedules as $schedule ) {
      $len = 60 * 60 * 24;
      $now = date( "Y-m-d" );
      $tmp = $schedule->date;

      if ( ( strtotime( $tmp ) - strtotime( $now ) ) / $len == 0 ) {
        array_push( $data['schedule'][0], $schedule );
      }
      else if ( ( strtotime( $tmp ) - strtotime( $now ) ) / $len == 1 ) {
        array_push( $data['schedule'][1], $schedule );
      }
      else if ( ( strtotime( $tmp ) - strtotime( $now ) ) / $len == 2 ) {
        array_push( $data['schedule'][2], $schedule );
      }
      else if ( ( strtotime( $tmp ) - strtotime( $now ) ) / $len == 3 ) {
        array_push( $data['schedule'][3], $schedule );
      }
      else if ( ( strtotime( $tmp ) - strtotime( $now ) ) / $len == 4 ) {
        array_push( $data['schedule'][4], $schedule );
      }
      else if ( ( strtotime( $tmp ) - strtotime( $now ) ) / $len == 5 ) {
        array_push( $data['schedule'][5], $schedule );
      }
      else if ( ( strtotime( $tmp ) - strtotime( $now ) ) / $len == 6 ) {
        array_push( $data['schedule'][6], $schedule );
      }
      else if ( ( strtotime( $tmp ) - strtotime( $now ) ) / $len == 7 ) {
        array_push( $data['schedule'][7], $schedule );
      }
    }

    return view( 'frontend.pages.reservation.schedule', compact( 'data' ) );
  }

  public function book( $schedule_id )
  {
    $data = [];
    $data['article'] = ArticleCategory::with( 'articles' )->get();
    $data['schedule'] = Schedule::with( 'doctor', 'clinic' )
                                ->where( 'id', $schedule_id )
                                ->first();

    return view( 'frontend.pages.reservation.book', compact( 'data' ) );
  }

  public function login( Request $request, $schedule_id )
  {
    if ( $request->ajax() ) {
      $email = Input::get( 'email' );
      $password = Input::get( 'pass' );

      if ( Auth::attempt( ['email' => $email, 'password' => $password], false ) ) {
        if ( Auth::user()->verified == '1' ) {
          return Response::json( [ 'success' => true ] );
        }
        else {
          Auth::logout();
          return Response::json( [
            'success' => false,
            'message' => "Akun anda belum terverifikasi silakan cek email anda.",
          ] );
        }
      }
      else {
        return Response::json( [
          'success' => false,
          'message' => "Kombinasi email dan password tidak cocok.",
        ] );
      }

      return Response::json( [
        'success' => false,
        'message' => "Mohon maaf terjadi kesalahan server, silakan ulangi proses login.",
      ] );
    }
  }

  public function confirm( Request $request, $schedule_id )
  {
    if ( $request->ajax() ) {
      $email = Input::get( 'email' );
      $patient = User::with( 'patient' )->where( 'email', $email )->get();
      $verification_token = substr( str_shuffle( "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ" ), 0, 8 );

      $reservation = Reservation::create( [
        'patient_id'  => $patient->patient->id,
        'schedule_id' => Input::get( 'schedule_id' ),
        'status'      => '0',
        'token'       => $verification_token,
        'verified'    => 0,
      ] );

      Mail::send( 'frontend.reservation.book', [ 'data' => $verification_token ], function( $m ) use ( $email ) {
        $m->from( 'team@dokternet.com', 'DokterNet-Indonesia' );
        $m->to( $email );
        $m->subject( 'DokterNet - Verifikasi Jadwal Pertemuan' );
      } );

      return Response::json( [ 'success' => true, 'reservation_id' => $reservation->id ] );
    }
  }

  public function verify( Request $request, $schedule_id )
  {
    if ( $request->ajax() ) {
      $reservation = Reservation::find( Input::get( 'reservation_id' ) );
      if ( $reservation->token == Input::get( 'verification_token' ) ) {
        $reservation->update( ['verified' => 1] );
        return Response::json( [ 'success' => true ] );
      }
      else {
        return Response::json( [
          'success' => false,
          'message' => "Kode verifikasi tidak sama, mohon masukkan kembali dengan nilai yang benar.",
        ] );
      }
    }
  }

  public function index()
  {
    $data = [];
    $data['article'] = ArticleCategory::with( 'articles' )->get();
    $data['content'] = Reservation::with( 'patient', 'schedule.doctor' )
                                  ->where( 'verified', 1 );

    if ( Input::get( 'data_content' ) == '2' ) {
      $data['content'] = $data['content']->where( 'status', "" );
    }
    else if ( Input::get( 'data_content' ) == '3' ) {
      $data['content'] = $data['content']->where( 'status', '1' );
    }
    else if ( Input::get( 'data_content' ) == '4' ) {
      $data['content'] = $data['content']->where( 'status', '2' );
    }
    else if ( Input::get( 'data_content' ) == '5' ) {
      $data['content'] = $data['content']->where( 'status', '3' );
    }
    else if ( Input::get( 'data_content' ) == '6' ) {
      $data['content'] = $data['content']->where( 'status', '4' );
    }

    $data['content'] = $data['content']->orderBy( 'created_at', 'desc' )
                                       ->get();
    return view( 'frontend.pages.clinic.reservation', compact( 'data' ) );
  }

  public function accept( $id )
  {
    Reservation::find( $id )->update( ['status' => '1'] );
    Session::flash( 'success', "Data reservasi jadwal dokter diterima" );
    return redirect()->back();
  }

  public function decline( $id )
  {
    Reservation::find( $id )->update( ['status' => '2'] );
    Session::flash( 'warning', "Data reservasi jadwal dokter ditolak" );
    return redirect()->back();
  }

  public function complete( $id )
  {
    $data = [];

    $data['article'] = ArticleCategory::with( 'articles' )->get();
    $data['reservation_id'] = $id;

    return view( 'frontend.pages.clinic.reservation-complete', compact( 'data' ) );
  }

  public function done( ReservationCompleteRequest $request )
  {
    Reservation::find( $request->id )->update( [
      'status'            => '4',
      'diagnosis_in'      => $request->diagnosis_in,
      'diagnosis_out'     => $request->diagnosis_out,
      'laboratory_result' => $request->laboratory_result,
      'activity'          => $request->activity,
      'note'              => $request->note
    ] );
    Session::flash( 'success', "Reservasi selesai" );
    return redirect()->route( 'clinic.reservation' );
  }

  public function cancel( $id )
  {
    Reservation::find( $id )->update( ['status' => '3'] );
    Session::flash( 'warning', "Data reservasi jadwal dokter dibatalkan" );
    return redirect()->back();
  }
}
