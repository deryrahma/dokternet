<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

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
}
