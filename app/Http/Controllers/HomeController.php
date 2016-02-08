<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\ArticleCategory;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];
        $data['article'] = ArticleCategory::with( 'articles')->get();
        $data['city'] = \App\City::all();
        $data['specialization'] = \App\Specialization::all();

        return view( 'frontend.pages.home.index', compact( 'data' ) );
    }

    public function search(Request $request)
    {
        $data = array();
        $data['article'] = ArticleCategory::with( 'articles')->get();
        $data['city'] = \App\City::all();
        $data['specialization'] = \App\Specialization::all();

        $data['city_k'] = urldecode($request->input('city'));
        $data['specialization_k'] = urldecode($request->input('specialization'));
        $data['keyword'] = urldecode($request->input('keyword'));

        $data['city_obj'] = \App\City::where('name','like','%'.$data['city_k'].'%')->lists('id');

        $result = \App\Specialization::where('name','like','%'.$data['specialization_k'].'%')
            ->whereHas('doctors', function($query) use($data){
                $query->whereIn('city_id', $data['city_obj'])
                    ->where('name','like', '%'.$data['keyword'].'%');
            })->with('doctors')->get();
        
        $data['article'] = ArticleCategory::with( 'articles')->get();
        $data['content'] = $result;
        return view('frontend.pages.home.search-result', compact('data'));
    }
    public function searchProfile($name)
    {
        $name = urldecode($name);
        $data = array();
        $data['article'] = \App\ArticleCategory::with( 'articles')->get();
        $data['content'] = \App\Doctor::where('name','like', '%'.$name.'%')->first();
        if(empty($data['content']))
            return redirect()->route('home');
        $data['schedule'] = [];

        for ( $i = 0; $i <= 7; $i++ ) {
          $data['schedule'][$i] = [];
        }

        $schedules = \App\Schedule::where( 'doctor_id', $data['content']->id )
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
        return view('frontend.pages.home.search-profile', compact('data'));
    }
    function blog(){
      $data['article'] = \App\ArticleCategory::with( 'articles')->get();
      $data['content'] = \App\Article::orderBy('created_at', 'desc')->paginate(10);
      return view('frontend.pages.home.blog', compact('data')); 
    }
}
