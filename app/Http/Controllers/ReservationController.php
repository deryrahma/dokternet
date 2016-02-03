<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\ArticleCategory;
use App\Schedule;

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
}
